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
        Schema::table('packages', function (Blueprint $table)
        {
            $table->boolean('no_limit_for_quiz')->default(0);
            $table->boolean('no_limit_for_question')->default(0);
            $table->boolean('for_all_specialities')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table)
        {
            //
        });
    }
};
