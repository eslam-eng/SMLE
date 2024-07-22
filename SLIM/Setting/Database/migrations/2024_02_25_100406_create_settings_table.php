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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('about_app');
            $table->string('logo');
            $table->string('website_icon');
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linked_in')->nullable();
            $table->boolean('is_difficult')->default(0);
            $table->boolean('timer')->default(0);
            $table->boolean('automatic_correct')->default(0);
            $table->boolean('try_answer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
