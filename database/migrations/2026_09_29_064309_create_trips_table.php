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
        Schema::create('trips', function (Blueprint $table) {
           $table->id();

            $table->foreignId('bus_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('employee_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('departure_city');
            $table->string('destination_city');

            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');

            $table->string('type');
            
            $table->string('status')->default('scheduled');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
