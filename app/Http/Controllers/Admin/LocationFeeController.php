<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationFee; // Correct model
use Illuminate\Http\Request;

class LocationFeeController extends Controller
{
    public function index()
    {
        $locations = LocationFee::all(); // Fetch all location fees
        return view('admin.location_fees.index', compact('locations'));
    }
    

    public function create()
    {
        return view('admin.location_fees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:location_fees,location_name',
            'fee' => 'required|numeric|min:0',
        ]);
    
        // Store the location fee
        LocationFee::create([
            'location_name' => $validated['name'],
            'fee' => $validated['fee'],
        ]);
    
        return redirect()->route('admin.location-fees.index')->with('success', 'Location fee added successfully.');
    }
    

    public function edit(LocationFee $locationFee)
    {
        return view('admin.location_fees.edit', compact('locationFee'));
    }

    public function update(Request $request, LocationFee $locationFee)
    {
        $request->validate([
            'location_name' => 'required|string|unique:location_fees,location_name,' . $locationFee->id,
            'fee' => 'required|numeric|min:0',
        ]);

        $locationFee->update($request->all());
        return redirect()->route('location-fees.index')->with('success', 'Location fee updated successfully.');
    }

    public function destroy(LocationFee $locationFee)
    {
        $locationFee->delete();
        return redirect()->route('location-fees.index')->with('success', 'Location fee deleted successfully.');
    }


}
