<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDivisi extends Model
{
    use HasFactory;
    protected $table = 'data_divisi'; // Nama tabel

    protected $fillable = [
        'divisi', // Kolom yang dapat diisi
    ];
}
