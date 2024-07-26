<?php

use App\Enum\SubscribeStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trainee_subscribes', function (Blueprint $table) {
            $table->string('subscribe_status')->default(SubscribeStatusEnum::PENDING->value);
            $table->string('payment_transaction_id')->comment('from bank system')->nullable();
            $table->string('payment_invoice_number')->comment('from payment gateway')->nullable();
            $table->integer('quizzes_count');
            $table->integer('remaining_quizzes')->default(0);
            $table->integer('num_available_question')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainee_subscribes', function (Blueprint $table) {
            //
        });
    }
};
