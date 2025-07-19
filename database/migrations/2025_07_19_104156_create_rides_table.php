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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();


            $table->string('fare')->nullable();
            $table->enum('payment_status', ['pending', 'completed'])->default('pending')->nullable();
            $table->enum('payment_mode', ['online', 'cash'])->nullable();
            $table->string('ride_time')->nullable();
            
            $table->string('pickup_location')->nullable();
            $table->string('pickup_lat')->nullable();
            $table->string('pickup_long')->nullable();

            $table->string('dropoff_location')->nullable();
            $table->string('dropoff_lat')->nullable();
            $table->string('dropoff_long')->nullable();

            $table->enum('status', ['pending', 'accepted', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();

            // foreign key if rider users table exists
            $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
