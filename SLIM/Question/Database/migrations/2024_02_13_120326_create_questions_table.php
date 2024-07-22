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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->string('answer_d');
            $table->string('model_answer');
            $table->bigInteger('level');
            $table->string('question_mark');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(1);
            $table->bigInteger('specialist_id')->unsigned();
            $table->foreign('specialist_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('sub_specialist_id')->unsigned();
            $table->foreign('sub_specialist_id')->references('id')->on('sub_specialties')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('level');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
