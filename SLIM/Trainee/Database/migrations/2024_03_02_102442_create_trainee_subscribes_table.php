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
        Schema::create('trainee_subscribes', function (Blueprint $table)
        {
            $table->id();

            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('trainee_id')->unsigned();

            $table->foreign('package_id')->references('id')->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('trainee_id')->references('id')->on('trainees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('package_type');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->decimal('amount');
            $table->string('invoice_file')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_subscribes');
    }
};
