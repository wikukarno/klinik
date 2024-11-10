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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('id_pasien', 12);
            $table->string('id_layanan', 12);
            $table->char('nik_pasien', 16)->unique();
            $table->char('no_bpjs', 13)->unique();
            $table->string('no_antrian', 10)->unique();

            $table->string('nama_pasien', 50);
            $table->string('no_hp_pasien', 15)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->date('tanggal_lahir');
            $table->date('tanggal_checkup')->nullable(); // jika pasien melahirkan
            $table->enum('status', ['menunggu', 'berlangsung', 'selesai'])->default('menunggu');
            $table->text('alamat_pasien');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
