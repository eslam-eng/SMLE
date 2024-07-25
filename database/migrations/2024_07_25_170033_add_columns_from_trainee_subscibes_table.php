<?php

use App\Enum\SubscribeStatusEnum;
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
        Schema::table('trainee_subscribes', function (Blueprint $table) {
            $table->string('subscribe_status')->default(SubscribeStatusEnum::PENDING->value);
            $table->string('payment_reference_number')->nullable();
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
