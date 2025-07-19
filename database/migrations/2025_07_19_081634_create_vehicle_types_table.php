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
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('vehicle_type', ['bike', 'car'])->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('description')->nullable(); // e.g., 300 km tak ki savvari
            $table->integer('price')->nullable(); // e.g., 1368
            $table->string('image')->nullable(); // path to image/icon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
