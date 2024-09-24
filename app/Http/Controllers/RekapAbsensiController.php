<?php

namespace App\Http\Controllers;

use App\Models\RekapAbsensi;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RekapAbsensiController extends Controller
{
    /**
     * Tampilkan daftar rekap absensi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rekapAbsensi = RekapAbsensi::with('karyawan')->get();
        return view('rekap_absensi.index', compact('rekapAbsensi'));
    }

    /**
     * Tampilkan form untuk membuat rekap absensi baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('rekap_absensi.create');
    }

    /**
     * Simpan rekap absensi baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'tanggal_hadir' => 'required|date',
        ]);

        // Logika untuk menghitung total dan menyimpan rekap absensi
        $idKaryawan = $request->input('id_karyawan');
        $tanggalHadir = $request->input('tanggal_hadir');

        $totalHadir = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('status_hadir', 'Hadir')
            ->count();

        $totalTidakHadir = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('status_hadir', 'Tidak Hadir')
            ->count();

        $totalSakit = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('status_hadir', 'Sakit')
            ->count();

        $totalIzin = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('status_hadir', 'Izin')
            ->count();

        $totalOntime = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('ketepatan_waktu', 'On Time')
            ->count();

        $totalTelat = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->where('ketepatan_waktu', 'Telat')
            ->count();

        $totalJamKerja = DataKehadiran::where('id_karyawan', $idKaryawan)
            ->where('tanggal_hadir', $tanggalHadir)
            ->sum(DB::raw('TIME_TO_SEC(lama_kerja)'));

        $rekap = new RekapAbsensi();
        $rekap->id_karyawan = $idKaryawan;
        $rekap->total_hadir = $totalHadir;
        $rekap->total_tidak_hadir = $totalTidakHadir;
        $rekap->total_sakit = $totalSakit;
        $rekap->total_izin = $totalIzin;
        $rekap->total_ontime = $totalOntime;
        $rekap->total_telat = $totalTelat;
        $rekap->total_jam_kerja = gmdate('H:i', $totalJamKerja);

        $rekap->save();

        return Redirect::route('rekap_absensi.index')->with('success', 'Rekap absensi berhasil disimpan.');
    }

    /**
     * Tampilkan form untuk mengedit rekap absensi.
     *
     * @param  \App\Models\RekapAbsensi  $rekapAbsensi
     * @return \Illuminate\View\View
     */
    public function edit(RekapAbsensi $rekapAbsensi)
    {
        return view('rekap_absensi.edit', compact('rekapAbsensi'));
    }

    /**
     * Update rekap absensi yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekapAbsensi  $rekapAbsensi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RekapAbsensi $rekapAbsensi)
    {
        $request->validate([
            'total_hadir' => 'required|integer',
            'total_tidak_hadir' => 'required|integer',
            'total_sakit' => 'required|integer',
            'total_izin' => 'required|integer',
            'total_ontime' => 'required|integer',
            'total_telat' => 'required|integer',
            'total_jam_kerja' => 'required|time',
        ]);

        $rekapAbsensi->update($request->all());

        return Redirect::route('rekap_absensi.index')->with('success', 'Rekap absensi berhasil diperbarui.');
    }

    /**
     * Hapus rekap absensi yang sudah ada.
     *
     * @param  \App\Models\RekapAbsensi  $rekapAbsensi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RekapAbsensi $rekapAbsensi)
    {
        $rekapAbsensi->delete();

        return Redirect::route('rekap_absensi.index')->with('success', 'Rekap absensi berhasil dihapus.');
    }
}
