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
     Schema::create('Porofolio_1202', function (Blueprint $table) {
        $table->id();
        $table->string('nama_proyek');
        $table->string('kategori'); // Contoh: Web Dev, Desain Grafis, UI/UX
        $table->text('deskripsi');
        $table->string('klien_perusahaan')->nullable();
        $table->string('link_proyek')->nullable(); // URL hasil kerjaan
        $table->string('gambar_proyek')->nullable(); // Foto portfolio
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
