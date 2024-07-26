<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \SLIM\Quiz\App\Models\Quiz::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('trainee_subscribe_id')->constrained('trainee_subscribes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
        });
    }
};
