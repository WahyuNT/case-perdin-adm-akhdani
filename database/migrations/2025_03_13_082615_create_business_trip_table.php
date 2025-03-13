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
        Schema::create('business_trip', function (Blueprint $table) {
          

            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('purpose_destination');
            $table->date('departure_date');
            $table->date('return_date');
            $table->foreignId('origin_city_id')->constrained('city')->onDelete('cascade');
            $table->foreignId('destination_city_id')->constrained('city')->onDelete('cascade');
            $table->integer('trip_duration')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('total_allowance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_trip');
    }
};
