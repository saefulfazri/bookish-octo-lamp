<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $divisi = [
            ['divisi' => 'Developer'],
            ['divisi' => 'Desain'],
            ['divisi' => 'Keuangan'],
        ];
        DB::table('data_divisi')->insert($divisi);
    }
}
