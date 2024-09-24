<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total karyawan
        $totalKaryawan = DataKaryawan::count();

        // Ambil tanggal terbaru dari data kehadiran
        $tanggalTerbaru = DataKehadiran::max('tanggal_hadir');

        // Total hadir pada tanggal terbaru
        $totalHadir = DataKehadiran::where('tanggal_hadir', $tanggalTerbaru)
                                    ->where('status_hadir', 'Hadir')
                                    ->count();


        // Total karyawan yang absen (tidak hadir dengan status Hadir, Izin, Sakit, atau Tidak Hadir)
        $totalAbsenKaryawanIds = DataKehadiran::where('tanggal_hadir', $tanggalTerbaru)
                                              ->pluck('id_karyawan')
                                              ->toArray();

        // Total karyawan yang belum absen pada tanggal terbaru
        $totalBelumAbsen = DataKaryawan::whereNotIn('id_karyawan', $totalAbsenKaryawanIds)->count();

        // Total tidak hadir pada tanggal terbaru
        $totalTidakHadir = DataKehadiran::where('tanggal_hadir', $tanggalTerbaru)
                                        ->where('status_hadir', ['Izin', 'Sakit', 'Tidak Hadir'])
                                        ->count();
        // Karyawan Paling Aktif Berdasarkan Jumlah Kehadiran
        $karyawanAktif = DataKehadiran::select('id_karyawan', DB::raw('COUNT(id_karyawan) as total_hadir'), DB::raw('SUM(TIME_TO_SEC(lama_kerja)) as total_jam_kerja'))
                                        ->groupBy('id_karyawan')
                                        ->orderBy('total_hadir', 'desc')
                                        ->orderBy('total_jam_kerja', 'desc')
                                        ->with('karyawan')
                                        ->first();

        // Kirim data ke view
        return view('dashboard', [
            'totalKaryawan' => $totalKaryawan,
            'totalHadir' => $totalHadir,
            'totalTidakHadir' => $totalTidakHadir,
            'totalBelumAbsen' => $totalBelumAbsen,
            'tanggalTerbaru' => $tanggalTerbaru,
            'karyawanAktif' => $karyawanAktif,
        ]);
    }

    private function determineBgClass($attendancePercentage)
    {
        if ($attendancePercentage == 100) {
            return 'bg-success';
        } elseif ($attendancePercentage >= 80) {
            return 'bg-info';
        } elseif ($attendancePercentage >= 60) {
            return 'bg-primary';
        } elseif ($attendancePercentage >= 40) {
            return 'bg-warning';
        } elseif ($attendancePercentage >= 20) {
            return 'bg-danger';
        } else {
            return 'bg-dark';
        }
    }
}
