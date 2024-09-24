<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataKaryawan;
use App\Models\DataKehadiran;
use App\Models\RekapAbsensi;
use Carbon\Carbon;

class RekapAbsensiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekap:absensi';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan rekap absensi setiap malam';


    /**
     * Execute the console command.
     */
    public function handle()
    {
     // Ambil semua karyawan
     $semuaKaryawan = DataKaryawan::all();

     // Ambil semua data kehadiran
     $dataKehadiran = DataKehadiran::all()->groupBy('id_karyawan');

     foreach ($semuaKaryawan as $karyawan) {
        // Ambil semua data kehadiran untuk karyawan
        $dataKehadiran = DataKehadiran::where('id_karyawan', $karyawan->id_karyawan)->get();

        // Hitung total hadir, izin, sakit, tidak hadir
        $totalHadir = $dataKehadiran->where('status_hadir', 'Hadir')->count();
        $totalIzin = $dataKehadiran->where('status_hadir', 'Izin')->count();
        $totalSakit = $dataKehadiran->where('status_hadir', 'Sakit')->count();
        $totalTidakHadir = $dataKehadiran->whereIn('status_hadir', ['Tidak Hadir'])->count();

        // Hitung total on time dan telat
        $totalOntime = $dataKehadiran->where('ketepatan_waktu', 'On Time')->count();
        $totalTelat = $dataKehadiran->where('ketepatan_waktu', 'Telat')->count();

        // Hitung total jam kerja
        $totalJamKerja = $dataKehadiran->sum(function ($item) {
            // Pastikan lama_kerja diubah menjadi Carbon jika bukan null
            return $item->lama_kerja ? Carbon::parse($item->lama_kerja)->hour * 3600 + Carbon::parse($item->lama_kerja)->minute * 60 : 0;
        });

        // Simpan rekap absensi ke tabel
        RekapAbsensi::updateOrCreate(
            ['id_karyawan' => $karyawan->id_karyawan],
            [
                'total_hadir' => $totalHadir,
                'total_tidak_hadir' => $totalTidakHadir,
                'total_sakit' => $totalSakit,
                'total_izin' => $totalIzin,
                'total_ontime' => $totalOntime,
                'total_telat' => $totalTelat,
                'total_jam_kerja' => gmdate('H:i:s', $totalJamKerja), // Convert to time format
            ]
        );
    }
    $this->info('Rekap absensi berhasil dilakukan.');
}
}

