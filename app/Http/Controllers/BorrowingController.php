<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\Borrowing;
use App\Models\District;
use App\Models\Village;
use Inertia\Inertia;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        $borrowings = Borrowing::with(['borrower', 'district', 'village', 'items.archive.category'])
            ->when($user->role === 'employee', function ($query) use ($user) {
                $query->where('borrower_id', $user->id);
            })
            ->when(request('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('borrowing_number', 'like', '%' . $search . '%')
                      ->orWhere('borrower_name', 'like', '%' . $search . '%')
                      ->orWhereHas('borrower', function ($sq) use ($search) {
                          $sq->where('name', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('borrowings/index', [
            'borrowings' => $borrowings,
            'filters' => request()->only(['status', 'search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ArchiveCategory::active()->with(['archives' => function ($query) {
            $query->where('status', 'available');
        }])->get();
        
        $districts = District::with('villages')->get();

        return Inertia::render('borrowings/create', [
            'categories' => $categories,
            'districts' => $districts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowingRequest $request)
    {
        $borrowing = Borrowing::create($request->validated());

        // Add borrowing items
        foreach ($request->archive_ids as $archiveId) {
            $borrowing->items()->create([
                'archive_id' => $archiveId,
                'status' => 'borrowed',
            ]);

            // Update archive status
            Archive::find($archiveId)->markAsBorrowed();
        }

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Peminjaman berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load([
            'borrower',
            'approver',
            'district',
            'village',
            'items.archive.category'
        ]);

        return Inertia::render('borrowings/show', [
            'borrowing' => $borrowing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Peminjaman yang sudah diproses tidak dapat diubah.');
        }

        $categories = ArchiveCategory::active()->with(['archives' => function ($query) {
            $query->where('status', 'available');
        }])->get();
        
        $districts = District::with('villages')->get();
        $borrowing->load(['items.archive.category', 'district', 'village']);

        return Inertia::render('borrowings/edit', [
            'borrowing' => $borrowing,
            'categories' => $categories,
            'districts' => $districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowingRequest $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Peminjaman yang sudah diproses tidak dapat diubah.');
        }

        // Reset archive status to available
        foreach ($borrowing->items as $item) {
            $item->archive->markAsAvailable();
        }
        
        // Delete old items
        $borrowing->items()->delete();

        // Update borrowing
        $borrowing->update($request->validated());

        // Add new borrowing items
        foreach ($request->archive_ids as $archiveId) {
            $borrowing->items()->create([
                'archive_id' => $archiveId,
                'status' => 'borrowed',
            ]);

            // Update archive status
            Archive::find($archiveId)->markAsBorrowed();
        }

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Peminjaman yang sudah diproses tidak dapat dihapus.');
        }

        // Reset archive status to available
        foreach ($borrowing->items as $item) {
            $item->archive->markAsAvailable();
        }

        $borrowing->delete();

        return redirect()->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dibatalkan.');
    }


}