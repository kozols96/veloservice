<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserBikeReservationTableAddColumnsStartingEnding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('user_bike_reservation', function (Blueprint $table) {
            $table->timestamp('starting_time')->nullable();
            $table->timestamp('ending_time')->nullable();
            $table->rename('user_bike_reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropColumns('user_bike_reservations', ['starting_time', 'ending_time']);
        Schema::rename('user_bike_reservations', 'user_bike_reservation');
    }
}
