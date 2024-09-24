<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RekapAbsensi extends Model
{
    use HasFactory;

    protected $table = 'rekap_absensi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'id_karyawan',
        'total_hadir',
        'total_tidak_hadir',
        'total_sakit',
        'total_izin',
        'total_ontime',
        'total_telat',
        'total_jam_kerja',
    ];


   
    public function karyawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'id_karyawan', 'id_karyawan');
    }
    public function calculateAverageWorkDuration()
    {
        // Ambil total jam kerja dari rekap absensi
        $totalJamKerja = $this->total_jam_kerja;

        // Cek jika total_jam_kerja kosong atau tidak valid
        if ($totalJamKerja === null || $totalJamKerja === '00:00') {
            return '00:00'; // Atau nilai default lainnya
        }

        // Hitung rata-rata lama kerja dari tabel data_kehadiran
        $totalLamaKerja = DataKehadiran::where('id_karyawan', $this->id_karyawan)
            ->whereDate('tanggal_hadir', $this->tanggal_hadir) // Asumsi tanggal_hadir ada di rekap_absensi
            ->sum(DB::raw('TIME_TO_SEC(lama_kerja)'));

        $jumlahKehadiran = DataKehadiran::where('id_karyawan', $this->id_karyawan)
            ->whereDate('tanggal_hadir', $this->tanggal_hadir) // Asumsi tanggal_hadir ada di rekap_absensi
            ->count();

        if ($jumlahKehadiran == 0) {
            return '00:00'; // Tidak ada data, kembalikan waktu default
        }

        // Hitung rata-rata lama kerja
        $rataRataLamaKerja = gmdate('H:i', $totalLamaKerja / $jumlahKehadiran);

        return $rataRataLamaKerja;
    }
}
