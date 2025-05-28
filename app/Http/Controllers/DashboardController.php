<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }   

     public function vehicles()
    {
        $vehicles = Vehicle::all();

        return view('vehicle.vehicles', compact('vehicles'));
    }

}
