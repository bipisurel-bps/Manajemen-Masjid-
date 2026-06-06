<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khatib_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->string('khatib_name');
            $table->string('theme')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khatib_schedules');
    }
};
