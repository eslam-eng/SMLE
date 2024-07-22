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
        Schema::create('packages_specialities', function (Blueprint $table)
        {
            $table->id();
            $table->bigInteger('specialist_id')->unsigned();
            $table->foreign('specialist_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('monthly_price')->default(0);
            $table->decimal('yearly_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages_specialities');
    }
};
