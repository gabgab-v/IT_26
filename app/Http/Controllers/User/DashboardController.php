<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderLog; // Import the OrderLog model

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Ensure the view path exists
    }

    public function showDashboard()
    {
        $logs = OrderLog::where('user_id', auth()->id())->latest()->get();
        return view('dashboard', compact('logs'));
    }
}
