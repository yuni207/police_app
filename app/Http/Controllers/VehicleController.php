<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{

    // app/Http/Controllers/Api/VehicleController.php

    public function index()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        return response()->json($vehicles);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'license_plate' => 'required|string|max:20',
            'type' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string',
            'is_stolen' => 'boolean',
        ]);

        $data['user_id'] = Auth::id();
        $vehicle = Vehicle::create($data);

        return response()->json([
            'message' => 'Vehicle berhasil ditambahkan',
            'data' => $vehicle
        ], 201);
    }

    public function show($id)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($vehicle);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'license_plate' => 'required|string|max:20',
            'type' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string',
            'is_stolen' => 'boolean',
        ]);

        $vehicle->update($data);

        return response()->json([
            'message' => 'Vehicle berhasil diubah',
            'data' => $vehicle
        ]);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::where('user_id', Auth::id())->findOrFail($id);
        $vehicle->delete();

        return response()->json(['message' => 'Vehicle berhasil dihapus']);
    }
}


