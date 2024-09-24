<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_karyawan', function (Blueprint $table) {
            $table->bigInteger('id_karyawan')->primary(); // Panjang yang sesuai untuk ID
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir');
            $table->string('alamat');
            $table->string('nomor');
            $table->string('jabatan')->nullable();
            $table->date('mulai_bekerja');
            $table->string('divisi')->nullable();
            $table->text('barcode')->nullable();
            $table->enum('Status_Karyawan', ['Aktif', 'tidak aktif'])->default('tidak aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_karyawan');
    }
};

