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
        Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Proyek (Misal: Website E-Commerce)
        $table->string('client_name')->nullable(); // Nama Klien
        $table->date('start_date'); // Tanggal Mulai
        $table->date('end_date');   // Target Selesai
        // Status Proyek
        $table->enum('status', ['pending', 'progress', 'completed', 'maintenance'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
