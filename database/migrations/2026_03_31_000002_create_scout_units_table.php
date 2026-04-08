<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scout_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('age_range');
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color', 20)->nullable();
            $table->string('accent_color', 40)->nullable();
            $table->string('leader_name')->nullable();
            $table->string('schedule')->nullable();
            $table->string('gender_scope')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scout_units');
    }
};
