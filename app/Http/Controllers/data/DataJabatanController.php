<?php

namespace App\Http\Controllers\data;

use App\Models\DataJabatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jabatan = DataJabatan::all();
        return view('data_jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('data_jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $existing = DataJabatan::where('nama_jabatan', $request->nama_jabatan)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'data ini sudah ada');
        }
        $jabatan  = DataJabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'deskripsi' => $request->deskripsi,
        ]);



        return redirect()->route('data_jabatan.index')->with('success', "Jabatan $jabatan->nama_jabatan berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jabatan = DataJabatan::findOrFail($id);
        return view('data_jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jabatan = DataJabatan::findOrFail($id);
        $existingJabatan = DataJabatan::where('nama_jabatan', $request->nama_jabatan)
        ->where('id', '!=', $id)
        ->first();

        if ($existingJabatan) {
        return redirect()->back()->with('error', 'Nama jabatan sudah ada, tidak dapat memperbarui.');
        }

        if ($jabatan->nama_jabatan === $request->nama_jabatan &&
            $jabatan->deskripsi === $request->deskripsi) {
        return redirect()->route('data_jabatan.index')->with('info', "Tidak ada perubahan pada jabatan $jabatan->nama_jabatan.");
        }

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('data_jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jabatan = DataJabatan::findOrFail($id);
        $jabatan = $jabatan->nama_jabatan;
        $jabatan->delete();

        return redirect()->route('data_jabatan.index')->with('success', "Jabatan $divisiName berhasil dihapus.");
    }
}
