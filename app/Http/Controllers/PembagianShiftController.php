<?php

namespace App\Http\Controllers;

use App\Models\PembagianShift;
use App\Models\DataKaryawan;
use Carbon\Carbon;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembagianShiftController extends Controller
{
    protected $hariMap = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shifts = Shift::all();
        $query = PembagianShift::query();

        $filtersApplied = false;

        if ($request->has('nama_karyawan') && $request->nama_karyawan !== '') {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('nama', $request->nama_karyawan);
            });
            $filtersApplied = true;
        }

        if ($request->has('bulan_tahun') && $request->bulan_tahun !== '') {
            $bulanTahun = $request->bulan_tahun;
            $query->whereMonth('tanggal', date('m', strtotime($bulanTahun)))
                  ->whereYear('tanggal', date('Y', strtotime($bulanTahun)));
            $filtersApplied = true;
        }

        $pembagianShifts = $filtersApplied ? $query->get() : collect();
        $karyawan = DataKaryawan::all();

        return view('pembagian_shift.index', compact('pembagianShifts', 'shifts', 'karyawan', 'filtersApplied'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = DataKaryawan::all();
        return view('pembagian_shift.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function edit(string $id)
    {
        //
        $pembagianShift = PembagianShift::findOrFail($id);
        return view('pembagian_shift.index', compact('PembagianShift'));
    }

    public function updateAll(Request $request)
    {
        $request->validate([
            'shifts.*.shift_id' => 'nullable|exists:shifts,id',
            'shifts.*.jam_mulai' => 'nullable|date_format:H:i',
            'shifts.*.jam_selesai' => 'nullable|date_format:H:i',
        ]);

        $updated = false;

        $shifts = $request->input('shifts', []);

        foreach ($shifts as $id => $shiftData) {
            $shift = PembagianShift::find($id);

            if ($shift) {
                // Simpan data lama untuk perbandingan
                $oldData = $shift->getAttributes();

                // Update model dengan data baru
                $shift->update($shiftData);

                // Cek apakah ada perubahan
                if ($shift->getAttributes() !== $oldData) {
                    $updated = true;
                }
            }
        }

        if ($updated) {
            return redirect()->route('pembagian_shift.index')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('pembagian_shift.index')->with('info', 'Tidak ada data yang diubah.');
        }
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'bulan_tahun' => 'required|date_format:Y-m',
            'shift_id' => 'nullable|exists:shifts,id', // Ubah ke 'shifts'
        ]);

        // Ambil bulan dan tahun dari input
        $bulanTahun = explode('-', $request->bulan_tahun);
        $tahun = $bulanTahun[0];
        $bulan = $bulanTahun[1];


         // Cek apakah data untuk bulan ini sudah ada
         $existingData = PembagianShift::where('id_karyawan', $request->id_karyawan)
         ->whereYear('tanggal', $tahun)
         ->whereMonth('tanggal', $bulan)
         ->exists();

         if ($existingData) {
         return redirect()->route('pembagian_shift.create')->with('info', 'Data untuk bulan ini sudah ada.');
         }
        // Mendapatkan jumlah hari dalam bulan
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;



        // Menambahkan data untuk setiap hari dalam bulan tersebut
        for ($hari = 1; $hari <= $jumlahHari; $hari++) {
            $tanggal = Carbon::create($tahun, $bulan, $hari)->toDateString();
            $namaHari = Carbon::create($tahun, $bulan, $hari)->translatedFormat('l');
            $namaHariIndonesia = $this->hariMap[$namaHari] ?? null;

            if ($namaHariIndonesia) {
                PembagianShift::updateOrCreate(
                    [
                        'id_karyawan' => $request->id_karyawan,
                        'tanggal' => $tanggal,
                    ],
                    [
                        'hari' => $namaHariIndonesia,
                        'shift_id' => $request->shift_id ?: null, // Set ke null jika shift_id kosong
                        'jam_mulai' => null,
                        'jam_selesai' => null,
                    ]
                );
            }
        }

        return redirect()->route('pembagian_shift.index')->with('success', 'Pembagian shift berhasil ditambahkan. Silakan lengkapi shift dan jam.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shift = PembagianShift::findOrFail($id);
        return response()->json($shift);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembagianShift = PembagianShift::findOrFail($id);
        $pembagianShift->delete();

        return redirect()->route('pembagian_shift.index')->with('success', 'Pembagian shift berhasil dihapus.');
    }
}
