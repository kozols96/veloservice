<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBikesTableModifyColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->timestamp('starting_time')->nullable()->change();
            $table->timestamp('ending_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->timestamp('starting_time')->change();
            $table->timestamp('ending_time')->change();
        });
    }
}
