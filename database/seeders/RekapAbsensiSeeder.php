<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekapAbsensiSeeder extends Seeder
{
    /**
     * Seed the database with rekap absensi data.
     *
     * @return void
     */
    public function run()
    {
        // Ambil data karyawan dari tabel data_karyawan
        $dataKaryawan = DB::table('data_karyawan')->pluck('id_karyawan');

        foreach ($dataKaryawan as $idKaryawan) {
            // Ambil tanggal hari ini

            // Hitung total kehadiran
            $totalHadir = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('status_hadir', 'Hadir')
                ->count();

            // Hitung total tidak hadir
            $totalTidakHadir = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('status_hadir', 'Tidak Hadir')
                ->count();

            // Hitung total sakit
            $totalSakit = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('status_hadir', 'Sakit')
                ->count();

            // Hitung total izin
            $totalIzin = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('status_hadir', 'Izin')
                ->count();

            // Hitung total ontime
            $totalOntime = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('ketepatan_waktu', 'On Time')
                ->count();

            // Hitung total telat
            $totalTelat = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->where('ketepatan_waktu', 'Telat')
                ->count();

            // Hitung total jam kerja
            $totalJamKerja = DB::table('data_kehadiran')
                ->where('id_karyawan', $idKaryawan)
                ->sum(DB::raw('TIME_TO_SEC(lama_kerja)'));

            // Format total jam kerja menjadi waktu
            $totalJamKerjaFormatted = gmdate('H:i:s', $totalJamKerja);

            // Simpan atau perbarui data di tabel rekap_absensi
            DB::table('rekap_absensi')->updateOrInsert(
                ['id_karyawan' => $idKaryawan],
                [
                    'total_hadir' => $totalHadir,
                    'total_tidak_hadir' => $totalTidakHadir,
                    'total_sakit' => $totalSakit,
                    'total_izin' => $totalIzin,
                    'total_ontime' => $totalOntime,
                    'total_telat' => $totalTelat,
                    'total_jam_kerja' => $totalJamKerjaFormatted,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
