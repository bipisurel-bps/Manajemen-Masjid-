<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('khatibs', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name');
            $table->text('notes')->nullable()->after('phone');
        });

        Schema::table('khatib_schedules', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('khatib_name');
        });
    }

    public function down(): void
    {
        Schema::table('khatibs', function (Blueprint $table) {
            $table->dropColumn(['phone', 'notes']);
        });

        Schema::table('khatib_schedules', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
