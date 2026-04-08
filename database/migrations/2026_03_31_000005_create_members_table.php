<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scout_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date');
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('parent_name')->nullable();
            $table->text('medical_notes')->nullable();
            $table->text('motivation')->nullable();
            $table->string('status', 30)->default('pending');
            $table->string('member_function', 50)->default('Membre');
            $table->string('role_title')->nullable();
            $table->date('registered_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
