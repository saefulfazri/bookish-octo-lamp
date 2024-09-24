<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PembagianShift extends Model
{
    use HasFactory;
    protected $table = 'pembagian_shift';

    protected $fillable = [
        'id_karyawan',
        'hari',
        'tanggal',
        'shift_id',
        'jam_mulai',
        'jam_selesai',
    ];

    public function karyawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }


      // Konversi 'jam_mulai' menjadi objek Carbon
      public function getJamMulaiAttribute($value)
      {
          return $value ? Carbon::parse($value) : null;
      }

      // Konversi 'jam_selesai' menjadi objek Carbon
      public function getJamSelesaiAttribute($value)
      {
          return $value ? Carbon::parse($value) : null;
      }
}
