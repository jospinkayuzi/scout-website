<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scout_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type', 50);
            $table->string('author')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->date('publication_date')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
