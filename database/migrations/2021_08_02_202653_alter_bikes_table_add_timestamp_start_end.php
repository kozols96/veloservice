<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBikesTableAddTimestampStartEnd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasColumns('bikes', ['starting_time', 'ending_time'])) {
            return;
        }

        Schema::table('bikes', function (Blueprint $table) {
            $table->timestamp('starting_time');
            $table->timestamp('ending_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropColumns('bikes', ['starting_time', 'ending_time']);
    }
}
