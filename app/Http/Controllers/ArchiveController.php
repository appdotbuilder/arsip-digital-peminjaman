<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use App\Models\Archive;
use App\Models\ArchiveCategory;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archives = Archive::with(['category'])
            ->when(request('category_id'), function ($query, $categoryId) {
                $query->where('archive_category_id', $categoryId);
            })
            ->when(request('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('archive_number', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        $categories = ArchiveCategory::active()->get();

        return Inertia::render('archives/index', [
            'archives' => $archives,
            'categories' => $categories,
            'filters' => request()->only(['category_id', 'status', 'search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ArchiveCategory::active()->get();

        return Inertia::render('archives/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArchiveRequest $request)
    {
        Archive::create($request->validated());

        return redirect()->route('archives.index')
            ->with('success', 'Arsip berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Archive $archive)
    {
        $archive->load(['category', 'borrowingItems.borrowing.borrower']);

        return Inertia::render('archives/show', [
            'archive' => $archive,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $archive)
    {
        $categories = ArchiveCategory::active()->get();
        $archive->load('category');

        return Inertia::render('archives/edit', [
            'archive' => $archive,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArchiveRequest $request, Archive $archive)
    {
        $archive->update($request->validated());

        return redirect()->route('archives.show', $archive)
            ->with('success', 'Arsip berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archive $archive)
    {
        if ($archive->borrowingItems()->where('status', 'borrowed')->count() > 0) {
            return back()->with('error', 'Arsip tidak dapat dihapus karena sedang dipinjam.');
        }

        $archive->delete();

        return redirect()->route('archives.index')
            ->with('success', 'Arsip berhasil dihapus.');
    }
}