<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('totem')->nullable();
            $table->string('guardian_relationship', 100)->nullable();
            $table->string('guardian_phone', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['totem', 'guardian_relationship', 'guardian_phone']);
        });
    }
};
