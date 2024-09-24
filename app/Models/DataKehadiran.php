<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKehadiran extends Model
{
    use HasFactory;

    protected $table = 'data_kehadiran';

    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_karyawan',
        'tanggal_hadir',
        'waktu_masuk',
        'waktu_keluar',
        'ketepatan_waktu',
        'lama_kerja',
        'status_hadir',
        'keterangan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'id_karyawan', 'id_karyawan');
    }
}
