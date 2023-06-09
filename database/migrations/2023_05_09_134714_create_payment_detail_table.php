<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Declaring the Payment Details table schema
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id('payment_detail_id');
            $table->foreignId('payment_id')->constrained('payments', 'payment_id')->onDelete('cascade');
            $table->foreignId('id')->constrainted('items', 'id')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
