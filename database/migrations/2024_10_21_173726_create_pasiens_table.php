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
            $table->string('nik_pasien', 16)->unique();
            $table->string('id_layanan', 12);
            $table->string('nama_pasien', 50);
            $table->date('tanggal_checkup')->nullable(); // jika pasien melahirkan
            $table->enum('status', ['menunggu', 'berlangsung', 'selesai'])->default('menunggu');
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
