<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBikesTableRemoveForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropForeign('bikes_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasColumn('bikes', 'user_id')) {
            return;
        }

        Schema::table('bikes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }
}
