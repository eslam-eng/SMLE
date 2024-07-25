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
        Schema::table('trainee_subscribes', function (Blueprint $table) {
            $table->dropForeign('trainee_subscribes_specialist_id_foreign');
            $table->dropColumn('specialist_id');
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
