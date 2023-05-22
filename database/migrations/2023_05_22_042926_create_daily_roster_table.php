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
        Schema::create('daily_rosters', function (Blueprint $table) {
            // $table->unsignedBigInteger('daily_roster_id');
            // $table->date('roster_date');
            // $table->time('roster_start_time');
            // $table->time('roster_end_time');
            // $table->unsignedBigInteger('weekly_roster_id');
            // $table->foreign('weekly_roster_id')->references('id')->on('weekly_rosters');
            // $table->timestamps();

            $table->id();
            $table->date('roster_date');
            $table->time('roster_start_time');
            $table->time('roster_end_time');
            $table->unsignedBigInteger('weekly_roster_id');
            $table->foreign('weekly_roster_id')->references('id')->on('weekly_rosters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyRoster');
    }
};
