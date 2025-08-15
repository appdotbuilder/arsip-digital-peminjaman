<?php

use App\Http\Controllers\ArchiveCategoryController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Archive Categories
    Route::resource('archive-categories', ArchiveCategoryController::class);
    
    // Archives
    Route::resource('archives', ArchiveController::class);
    
    // Borrowings
    Route::resource('borrowings', BorrowingController::class);
        
    // API Routes for AJAX requests
    Route::get('/api/districts/{district}/villages', function ($district) {
        return \App\Models\District::with('villages')->findOrFail($district)->villages;
    })->name('api.districts.villages');
    
    Route::get('/api/categories/{category}/archives', function ($category) {
        return \App\Models\ArchiveCategory::with(['archives' => function ($query) {
            $query->where('status', 'available');
        }])->findOrFail($category)->archives;
    })->name('api.categories.archives');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';