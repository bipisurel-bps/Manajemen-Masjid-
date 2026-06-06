<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajian_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('day_of_week')->nullable()->comment('Senin, Selasa, etc. for recurring');
            $table->date('date')->nullable()->comment('For one-time special events');
            $table->time('time');
            $table->string('ustadz_name');
            $table->string('location')->nullable();
            $table->enum('type', ['rutin', 'khusus'])->default('rutin');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajian_schedules');
    }
};
