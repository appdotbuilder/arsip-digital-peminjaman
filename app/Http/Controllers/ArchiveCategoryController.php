<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArchiveCategoryRequest;
use App\Http\Requests\UpdateArchiveCategoryRequest;
use App\Models\ArchiveCategory;
use Inertia\Inertia;

class ArchiveCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ArchiveCategory::with('archives')
            ->withCount('archives')
            ->latest()
            ->paginate(10);

        return Inertia::render('archive-categories/index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('archive-categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArchiveCategoryRequest $request)
    {
        ArchiveCategory::create($request->validated());

        return redirect()->route('archive-categories.index')
            ->with('success', 'Kategori arsip berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArchiveCategory $archiveCategory)
    {
        $archiveCategory->load(['archives' => function ($query) {
            $query->latest()->paginate(10);
        }]);

        return Inertia::render('archive-categories/show', [
            'category' => $archiveCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArchiveCategory $archiveCategory)
    {
        return Inertia::render('archive-categories/edit', [
            'category' => $archiveCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArchiveCategoryRequest $request, ArchiveCategory $archiveCategory)
    {
        $archiveCategory->update($request->validated());

        return redirect()->route('archive-categories.show', $archiveCategory)
            ->with('success', 'Kategori arsip berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArchiveCategory $archiveCategory)
    {
        if ($archiveCategory->archives()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki arsip.');
        }

        $archiveCategory->delete();

        return redirect()->route('archive-categories.index')
            ->with('success', 'Kategori arsip berhasil dihapus.');
    }
}