<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        $existingShift = Shift::where('nama_shift', $request->nama_shift)->first();

        if ($existingShift) {
            return redirect()->back()->with('error', 'Nama shift sudah ada, tidak dapat membuat shift baru.');
        }
        $shifts = Shift::create([
            'nama_shift' => $request->nama_shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('shifts.index')->with('success', "Shift $shifts->nama_shift berhasil di buat.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $shift = Shift::findOrFail($id);
        return view('shifts.show', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $shift = Shift::findOrFail($id);
        return view('shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama_shift'=>'required|string|max:255',
        ]);

        $shift = Shift::findOrFail($id);

        $existingShift = Shift::where('nama_shift', $request->nama_shift)
            ->where('id', '!=', $id)
            ->first();

        if ($existingShift) {

            return redirect()->back()->with('error', 'Nama shift sudah ada, tidak dapat memperbarui.');
        }

        if ($shift->nama_shift === $request->nama_shift &&
            $shift->jam_mulai === $request->jam_mulai &&
            $shift->jam_selesai === $request->jam_selesai) {
            // Jika tidak ada perubahan, redirect tanpa melakukan update
            return redirect()->route('shifts.index')->with('info', 'Tidak ada perubahan pada shift.');
        }

        // Perbarui shift dengan data baru
        $shift->update([
            'nama_shift' => $request->nama_shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

            return redirect()->route('shifts.index')->with('succes','shift updated selesai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $shift = Shift::findOrFail($id);
        $shiftName = $shift->nama_shift;
        $shift->delete();

        return redirect()->route('shifts.index')->with('success', "Shift $shiftName berhasil dihapus.");
    }
}
