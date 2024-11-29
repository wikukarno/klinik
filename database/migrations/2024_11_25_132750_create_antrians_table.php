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
        Schema::create('antrian', function (Blueprint $table) {
            $table->id('id_antrian');
            $table->string('no_antrian');
            $table->string('layanan_id', 11);
            $table->string('pasien_id', 11);
            $table->enum('status', ['menunggu', 'berlangsung', 'selesai', 'dilewati', 'batal'])->default('menunggu');
            $table->string('posisi')->default('petugas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
