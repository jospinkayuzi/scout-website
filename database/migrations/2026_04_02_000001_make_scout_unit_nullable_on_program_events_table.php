<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_events', function (Blueprint $table) {
            $table->dropForeign(['scout_unit_id']);
        });

        Schema::table('program_events', function (Blueprint $table) {
            $table->unsignedBigInteger('scout_unit_id')->nullable()->change();
            $table->foreign('scout_unit_id')->references('id')->on('scout_units')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('program_events', function (Blueprint $table) {
            $table->dropForeign(['scout_unit_id']);
        });

        Schema::table('program_events', function (Blueprint $table) {
            $table->unsignedBigInteger('scout_unit_id')->nullable(false)->change();
            $table->foreign('scout_unit_id')->references('id')->on('scout_units')->cascadeOnDelete();
        });
    }
};
