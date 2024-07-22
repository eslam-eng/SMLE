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
        Schema::create('sub_specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('number_question')->nullable();
            $table->bigInteger('number_user')->nullable();
            $table->boolean('is_active')->default(true);
            $table->bigInteger('specialist_id')->unsigned();
            $table->foreign('specialist_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subspecialties');
    }
};
