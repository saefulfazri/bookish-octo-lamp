<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataDivisi;

class DataDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $divisi = DataDivisi::all();
        return view('divisi.index', compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validasi input
        $request->validate([
            'divisi' => 'required|string|max:255',
        ]);

        $existing = DataDivisi::where('divisi', $request->divisi)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'data ini sudah ada');
        }

        $divisi = DataDivisi::create([
            'divisi' => $request->divisi,
        ]);


        return redirect()->route('divisi.index')->with('success', "Divisi $divisi->divisi berhasil ditambahkan.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $divisi = DataDivisi::findOrFail($id);
        return view('divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'divisi' => 'required|string|max:255'
        ]);

        $divisi = DataDivisi::findOrFail($id);

        $existingDivisi = DataDivisi::where('divisi', $request->divisi)
            ->where('id', '!=', $id)
            ->first();

        if ($existingDivisi) {
            return redirect()->back()->with('error', 'data sudah ada,tidak dapat memperbarui');
        }

        if ($divisi->divisi === $request->divisi) {
            return redirect()->route('divisi.index')->with('info', 'Tidak ada perubahan data.');
        }

        $divisi->update([
            'divisi' => $request->divisi,
        ]);

        return redirect()->route('divisi.index')->with('success', 'divisi berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $divisi = DataDivisi::findOrFail($id);
        $divisiName = $divisi->divisi;
        $divisi->delete();


        return redirect()->route('divisi.index')->with('success', "Divisi $divisiName berhasil di hapus");
    }
}
