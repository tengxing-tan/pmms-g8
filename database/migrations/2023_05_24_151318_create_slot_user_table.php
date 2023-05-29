<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('slot_user', function (Blueprint $table) {
            $table->foreignId('slot_id')->constrained('slot');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        
            $table->unique(['slot_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_user');
    }
};
