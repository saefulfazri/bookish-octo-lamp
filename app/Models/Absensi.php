<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    // Daftar atribut yang dapat diisi secara massal
    protected $fillable = [
        'id_karyawan',
        'tanggal_hadir',
        'jam_masuk',
        'jam_keluar',
        'status_hadir',
    ];

    // Jika menggunakan ID yang bukan integer (jika perlu)
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Definisikan relasi dengan model DataKaryawan
    public function karyawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'id_karyawan', 'id_karyawan');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
