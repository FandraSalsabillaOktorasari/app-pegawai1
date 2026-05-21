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
        // 1. Tabel Master Skill
    Schema::create('skills', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Laravel, React, Docker
        $table->enum('category', ['framework', 'language', 'database', 'tool'])->default('language');
        $table->timestamps();
    });

    // 2. Tabel Pivot (Pegawai <-> Skill)
    Schema::create('employee_skill', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        $table->foreignId('skill_id')->constrained()->onDelete('cascade');
        // Level penguasaan skill
        $table->enum('level', ['beginner', 'intermediate', 'expert'])->default('beginner');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_skill');
        Schema::dropIfExists('skills');
    }
};
