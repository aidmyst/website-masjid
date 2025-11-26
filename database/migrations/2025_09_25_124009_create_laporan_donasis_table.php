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
        Schema::create('laporan_donasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kategori'); // e.g., 'pintu_surga', 'bmt', 'jumat', 'kebersihan'
            $table->text('deskripsi');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_donasis');
    }
};
