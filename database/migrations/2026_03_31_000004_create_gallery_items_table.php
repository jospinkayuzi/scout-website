<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scout_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('event_name')->nullable();
            $table->string('media_type', 30)->default('image');
            $table->string('media_path');
            $table->text('caption')->nullable();
            $table->date('taken_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
