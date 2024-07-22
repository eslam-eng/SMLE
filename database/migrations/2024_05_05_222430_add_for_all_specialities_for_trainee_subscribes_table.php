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
        Schema::table('trainee_subscribes', function (Blueprint $table)
        {
            $table->boolean('for_all_specialities')->default(0);
            $table->bigInteger('specialist_id')->nullable()->unsigned();
            $table->foreign('specialist_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainee_subscribes', function (Blueprint $table)
        {
            $table->dropColumn('for_all_specialities');
            $table->dropColumn('specialist_id');
        });

    }
};
