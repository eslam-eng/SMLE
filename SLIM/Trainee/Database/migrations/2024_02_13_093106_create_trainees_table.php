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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('phone_code')->nullable();
            $table->string('user_name')->unique();
            $table->string('degree');
            $table->string('otp')->nullable();

            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->bigInteger('specialist_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();

            $table->foreign('specialist_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
