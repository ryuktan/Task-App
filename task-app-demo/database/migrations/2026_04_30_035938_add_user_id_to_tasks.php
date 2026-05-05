<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the 'tasks' table exists first
        if (Schema::hasTable('tasks')) {
            Schema::table('tasks', function (Blueprint $table) {
                // Only add 'user_id' if it doesn't already exist in the database
                if (!Schema::hasColumn('tasks', 'user_id')) {
                    $table->foreignId('user_id')
                          ->constrained()
                          ->cascadeOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('tasks', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};