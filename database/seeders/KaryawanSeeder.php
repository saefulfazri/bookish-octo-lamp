<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Faker\Factory as Faker;
use App\Http\Controllers\DataKaryawanController;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $controller = App::make(DataKaryawanController::class);

        $karyawan = [];

        for ($i = 0; $i < 10; $i++) {
            $id_karyawan = random_int(100000, 999999);

            // Generate barcode
            $barcode = $controller->generateBarcode($id_karyawan);

            $karyawan[] = [
                'id_karyawan' => $id_karyawan,
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Pria', 'Wanita']),
                'tanggal_lahir' => $faker->date,
                'pendidikan_terakhir' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
                'alamat' => $faker->address,
                'nomor' => $faker->phoneNumber,
                'mulai_bekerja' => $faker->date,
                'barcode' => $barcode,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('data_karyawan')->insert($karyawan);
    }
}
