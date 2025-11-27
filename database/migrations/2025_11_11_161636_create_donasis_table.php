<?php
// File: ...create_donasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donatur_id')->constrained('donaturs')->onDelete('cascade'); // Relasi ke donatur
            $table->string('kategori');
            $table->decimal('nominal', 15, 2); // Gunakan decimal untuk uang
            $table->string('bukti_tf'); // Path ke file bukti transfer
            $table->string('status')->default('pending'); // Untuk admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};