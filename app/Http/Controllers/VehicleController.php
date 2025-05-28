<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{

    // app/Http/Controllers/Api/VehicleController.php

    public function index(Request $request)
    {
        try {
            $vehicles = $request->user()->vehicles;

            return response()->json([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil ditemukan.',
                'data' => $vehicles,
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving vehicles: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal mengambil data kendaraan.',
                'data' => [],
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'license_plate' => 'required|string|max:20',
            'type' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string',
            'is_stolen' => 'boolean',
        ], [
            'license_plate.required' => 'Plat nomor wajib diisi.',
            'license_plate.string' => 'Plat nomor harus berupa teks.',
            'license_plate.max' => 'Plat nomor maksimal 20 karakter.',

            'type.required' => 'Tipe kendaraan wajib diisi.',
            'type.string' => 'Tipe kendaraan harus berupa teks.',

            'brand.required' => 'Merk kendaraan wajib diisi.',
            'brand.string' => 'Merk kendaraan harus berupa teks.',

            'color.required' => 'Warna kendaraan wajib diisi.',
            'color.string' => 'Warna kendaraan harus berupa teks.',

            'is_stolen.boolean' => 'Status pencurian harus berupa nilai ya/tidak.',
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


