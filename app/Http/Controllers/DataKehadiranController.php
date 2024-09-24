<?php

namespace App\Http\Controllers;

use App\Models\DataKehadiran;
use App\Models\DataKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DataKehadiran::with('karyawan');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_hadir', [$request->start_date, $request->end_date]);
        }

        $dataKehadiran = $query->get();

        return view('data_kehadiran.index', compact('dataKehadiran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = DataKaryawan::all();

        return view('data_kehadiran.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'tanggal_hadir' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'ketepatan_waktu' => 'nullable|in:On Time,Telat',
            'lama_kerja' => 'nullable',
            'status_hadir' => 'required|in:Hadir,Izin,Sakit,Tidak Hadir',
            'keterangan' => 'nullable|string',
        ]);

        // Hitung lama kerja jika waktu masuk dan waktu keluar tersedia
        $lamaKerja = null;
        if ($request->waktu_masuk && $request->waktu_keluar) {
            try {
                $waktuMasuk = new \DateTime($request->waktu_masuk);
                $waktuKeluar = new \DateTime($request->waktu_keluar);

                // Pastikan waktu keluar lebih besar dari waktu masuk
                if ($waktuKeluar < $waktuMasuk) {
                    throw new \Exception('Waktu keluar tidak boleh kurang dari waktu masuk.');
                }

                $interval = $waktuKeluar->diff($waktuMasuk);
                $lamaKerja = $interval->format('%h:%i'); // Format H:i, misalnya "05:30"
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan pada format waktu: ' . $e->getMessage()]);
            }
        }

        // Tambahkan lama kerja ke data yang akan disimpan
        $data = $request->all();
        $data['lama_kerja'] = $lamaKerja;

        // Buat catatan kehadiran baru
        DataKehadiran::create($data);

        return redirect()->route('data_kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataKehadiran = DataKehadiran::with('karyawan')->findOrFail($id);

        return view('data_kehadiran.show', compact('dataKehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataKehadiran = DataKehadiran::findOrFail($id);
        $karyawan = DataKaryawan::all();

        return view('data_kehadiran.edit', compact('dataKehadiran', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'tanggal_hadir' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'ketepatan_waktu' => 'nullable|in:On Time,Telat',
            'lama_kerja' => 'nullable',
            'status_hadir' => 'required|in:Hadir,Izin,Sakit,Tidak Hadir',
            'keterangan' => 'nullable|string',
        ]);

        // Update attendance record
        $dataKehadiran = DataKehadiran::findOrFail($id);

        // Hitung lama kerja jika waktu masuk dan waktu keluar tersedia
        $lamaKerja = null;
        if ($request->waktu_masuk && $request->waktu_keluar) {
            try {
                $waktuMasuk = new \DateTime($request->waktu_masuk);
                $waktuKeluar = new \DateTime($request->waktu_keluar);

                // Pastikan waktu keluar lebih besar dari waktu masuk
                if ($waktuKeluar < $waktuMasuk) {
                    throw new \Exception('Waktu keluar tidak boleh kurang dari waktu masuk.');
                }

                $interval = $waktuKeluar->diff($waktuMasuk);
                $lamaKerja = $interval->format('%h:%i'); // Format H:i, misalnya "05:30"
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan pada format waktu: ' . $e->getMessage()]);
            }
        }

        // Update data
        $data = $request->all();
        $data['lama_kerja'] = $lamaKerja;
        $dataKehadiran->update($data);

        return redirect()->route('data_kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataKehadiran = DataKehadiran::findOrFail($id);
        $dataKehadiran->delete();

        return redirect()->route('data_kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus.');
    }


}
