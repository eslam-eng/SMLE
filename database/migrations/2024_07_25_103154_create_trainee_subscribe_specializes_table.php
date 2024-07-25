<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainee_subscribe_specializes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainee_subscribe_id')->constrained('trainee_subscribes');
            $table->foreignId('package_id')->constrained('packages');
            $table->foreignId('specialist_id')->constrained('specializations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_subscribe_specializes');
    }
};
