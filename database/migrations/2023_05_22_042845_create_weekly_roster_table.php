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
        Schema::create('weekly_rosters', function (Blueprint $table) {
            // $table->unsignedBigInteger('weekly_roster_id');
            // $table->date('date');
            // $table->time('startTime');
            // $table->time('endTime');
            // $table->timestamps();

            $table->id();
            // $table->date('date');
            // $table->time('startTime');
            // $table->time('endTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_rosters');
    }
};
