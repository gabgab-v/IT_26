<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationFee;

class HomeController extends Controller
{
    //
    public function showPage()
    {
        $locationFees = LocationFee::all(); // Fetch data from the database
        return view('home', compact('locationFees')); // Pass data to the Blade view
    }
}
