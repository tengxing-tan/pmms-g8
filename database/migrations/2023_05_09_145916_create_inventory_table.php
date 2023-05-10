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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('inventory_id');
            // $table->foreignId('item_id');
            $table->foreignId('daily_roster_id');
            $table->integer('opening_quantity');
            $table->integer('closing_quantity');
            $table->integer('current_quantity');
            $table->string('comment')->nullable();
            $table->timestamps();
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
