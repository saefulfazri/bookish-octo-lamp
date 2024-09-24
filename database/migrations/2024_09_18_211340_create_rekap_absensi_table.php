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
        Schema::create('rekap_absensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_karyawan');
            $table->Integer('total_hadir');
            $table->Integer('total_tidak_hadir');
            $table->Integer('total_sakit');
            $table->Integer('total_izin');
            $table->Integer('total_ontime');
            $table->Integer('total_telat');
            $table->time('total_jam_kerja');
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id_karyawan')->on('data_karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_absensi');
    }
};
