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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('quiz_date');
            $table->bigInteger('mark')->nullable();
            $table->bigInteger('question_no');
            $table->boolean('question_stop_watch')->nullable();
            $table->bigInteger('question_time')->nullable();
            $table->boolean('auto_correction')->nullable();
            $table->bigInteger('number_attempt_allowed')->nullable();
            $table->string('level')->default(0);
            $table->decimal('quiz_time')->nullable();
            $table->bigInteger('trainee_id')->unsigned();

            $table->foreign('trainee_id')->references('id')->on('trainees')->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
