<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scout_units', function (Blueprint $table) {
            $table->json('planned_activities')->nullable()->after('schedule');
        });
    }

    public function down(): void
    {
        Schema::table('scout_units', function (Blueprint $table) {
            $table->dropColumn('planned_activities');
        });
    }
};
