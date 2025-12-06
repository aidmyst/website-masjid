<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jadwal_khatibs', function (Blueprint $table) {
            $table->id();
            $table->string('jumat_1')->nullable();
            $table->string('jumat_2')->nullable();
            $table->string('jumat_3')->nullable();
            $table->string('jumat_4')->nullable();
            $table->string('jumat_5')->nullable(); // Jaga-jaga kalau ada pekan ke-5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_khatibs');
    }
};
