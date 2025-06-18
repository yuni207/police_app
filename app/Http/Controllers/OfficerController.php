<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;

class OfficerController extends Controller
{

    // app/Http/Controllers/Api/OfficerController.php

    // Tampilkan semua officer
    public function index()
    {
        $officers = Officer::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar officer berhasil diambil.',
            'data' => $officers
        ]);
    }

    // Simpan officer baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'badge_number' => 'required|string|max:20|unique:officers,badge_number',
            'rank' => 'required|string|max:50',
            'assigned_area' => 'required|string|max:100',
        ]);

        $officer = Officer::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Officer berhasil ditambahkan.',
            'data' => $officer
        ], 201);
    }

    // Tampilkan officer berdasarkan ID
    public function show($id)
    {
        $officer = Officer::find($id);

        if (!$officer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Officer tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $officer
        ]);
    }

    // Update data officer
    public function update(Request $request, $id)
    {
        $officer = Officer::find($id);

        if (!$officer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Officer tidak ditemukan.'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'badge_number' => 'required|string|max:20|unique:officers,badge_number,' . $id,
            'rank' => 'required|string|max:50',
            'assigned_area' => 'required|string|max:100',
        ]);

        $officer->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data officer berhasil diperbarui.',
            'data' => $officer
        ]);
    }

    // Hapus officer
    public function destroy($id)
    {
        $officer = Officer::find($id);

        if (!$officer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Officer tidak ditemukan.'
            ], 404);
        }

        $officer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Officer berhasil dihapus.'
        ]);
    }
}
