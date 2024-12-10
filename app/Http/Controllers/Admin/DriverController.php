<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function pendingDrivers()
    {
        $drivers = Driver::where('status', 'pending')->get();
        return view('admin.pending_drivers', compact('drivers'));
    }

    public function approveDriver($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = 'approved';
        $driver->save();

        return redirect()->route('admin.drivers.pending')->with('message', 'Driver approved successfully.');
    }

    public function rejectDriver($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = 'rejected';
        $driver->save();

        return redirect()->route('admin.drivers.pending')->with('message', 'Driver rejected successfully.');
    }
}
