<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_kehadiran', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->bigInteger('id_karyawan');
            $table->date('tanggal_hadir');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->enum('ketepatan_waktu', ['On Time', 'Telat'])->nullable();
            $table->time('lama_kerja')->nullable();
            $table->enum('status_hadir', ['Hadir', 'Izin', 'Sakit', 'Tidak Hadir']);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_karyawan')->references('id_karyawan')->on('data_karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kehadiran');
    }
};
