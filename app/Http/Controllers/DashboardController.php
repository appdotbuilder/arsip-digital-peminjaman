<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Borrowing;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
    {
        $user = auth()->user();
        $stats = [];

        switch ($user->role) {
            case 'admin':
                $stats = [
                    'total_users' => User::count(),
                    'total_archives' => Archive::count(),
                    'total_borrowings' => Borrowing::count(),
                    'pending_borrowings' => Borrowing::where('status', 'pending')->count(),
                    'overdue_borrowings' => Borrowing::overdue()->count(),
                    'available_archives' => Archive::where('status', 'available')->count(),
                    'borrowed_archives' => Archive::where('status', 'borrowed')->count(),
                ];
                break;
                
            case 'officer':
                $stats = [
                    'total_archives' => Archive::count(),
                    'total_borrowings' => Borrowing::count(),
                    'pending_borrowings' => Borrowing::where('status', 'pending')->count(),
                    'overdue_borrowings' => Borrowing::overdue()->count(),
                    'available_archives' => Archive::where('status', 'available')->count(),
                    'borrowed_archives' => Archive::where('status', 'borrowed')->count(),
                ];
                break;
                
            case 'employee':
                $stats = [
                    'my_borrowings' => Borrowing::where('borrower_id', $user->id)->count(),
                    'pending_borrowings' => Borrowing::where('borrower_id', $user->id)->where('status', 'pending')->count(),
                    'active_borrowings' => Borrowing::where('borrower_id', $user->id)->whereIn('status', ['approved', 'borrowed', 'partially_returned'])->count(),
                    'overdue_borrowings' => Borrowing::where('borrower_id', $user->id)->overdue()->count(),
                    'total_archives' => Archive::where('status', 'available')->count(),
                ];
                break;
        }

        return Inertia::render('dashboard', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }
}