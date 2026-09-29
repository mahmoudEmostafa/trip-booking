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
        Schema::create('booking_seats', function (Blueprint $table) {
            $table->id();

    $table->foreignId('booking_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('trip_seat_id')
        ->constrained()
        ->restrictOnDelete();

    $table->unique('trip_seat_id');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_seats');
    }
};
