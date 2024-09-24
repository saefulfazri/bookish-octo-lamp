<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\DataKaryawan;

class simpanAbsensiCommand extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:simpanAbsensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menyimpan data dari table absensi ke history_absensi';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        //
        $this->fix_data();

    }

    public function fix_data()
    {
        DataKaryawan::query()->update([
            'status_hadir' => 'Tidak Hadir',
        ]);

        $absensiRecords = DB::table('absensi')->get();
        foreach ($absensiRecords as $record) {

            if ($record->status_hadir === 'Hadir') {
                $jamMasuk = $record->jam_masuk ?: '8:00:00';
                $jamKeluar = $record->jam_keluar ?: '17:00:00';
            } else {
                $jamMasuk = $record->jam_masuk;
                $jamKeluar = $record->jam_keluar;
            }
            DB::table('history_absensi')->insert([
                'id_karyawan' => $record->id_karyawan,
                'tanggal_hadir' => $record->tanggal_hadir,
                'jam_masuk' => $jamMasuk,
                'jam_keluar' => $jamKeluar,
                'alasan_tidak_masuk' => $record->alasan_tidak_masuk,
                'status_hadir' => $record->status_hadir,
                'created_at' => $record->created_at,
                'updated_at' => $record->updated_at,
            ]);
        }
        DB::table('absensi')->truncate();

        $this->info('data absensi berhasil disimpan ke history_absensi');
    }
}


