<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';

    protected $fillable = ['nama_shift', 'jam_mulai', 'jam_selesai'];

    public function schedules()
    {
        return $this->hasMany(ShiftSchedule::class);
    }
}
