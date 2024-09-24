<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class DataKaryawan extends Model
{
    use HasFactory;
    protected $table = 'data_karyawan';


    // Jika menggunakan auto-increment integer ID
    // protected $primaryKey = 'id_karyawan';

    // Untuk ID yang bukan integer (jika perlu)
    protected $primaryKey = 'id_karyawan';
    public $incrementing = false;
    protected $keyType = 'bigInteger';


    protected $fillable = [
        'id_karyawan',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'alamat',
        'nomor',
        'jabatan',
        'mulai_bekerja',
        'divisi',
        'Status_Karyawan',
        'barcode',
    ];

    protected static function booted()
    {
        static::creating(function ($karyawan) {
            $karyawan->id_karyawan = random_int(100000, 999999);
            $karyawan->barcode = random_int(100000, 999999);// Generate UUID for ID
        });
    }

    public $timestamps = true;

    // Relasi one-to-many dengan Absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan', 'id_karyawan');
    }
    
    public function jabatan()
    {
        return $this->belongsTo(DataJabatan::class, 'jabatan_id', 'id');
    }

    // Relasi one-to-one dengan RekapAbsensi
    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        // Your logic to determine status
        $absensi = $this->absensis()->latest()->first(); // Assuming relationship with absensi

        if ($absensi) {
            return $absensi->status_hadir; // Return the status_hadir from the absensi table
        }

        return 'Unknown'; // Default if no record is found
    }
}
