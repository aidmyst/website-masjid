<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('organisasi');

        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('divisi');
            $table->integer('urutan')->default(100); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};