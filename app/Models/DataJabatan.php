<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJabatan extends Model
{
    use HasFactory;

    protected $table = 'data_jabatan';

    protected $fillable = [
        'nama_jabatan',
        'deskripsi',
    ];

    public function karyawan()
    {
        return $this->hasMany(DataKaryawan::class, 'jabatan_id', 'id');
    }
}
