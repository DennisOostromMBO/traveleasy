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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('travel_id')->constrained('travels')->onDelete('cascade');
            $table->string('departure_country');
            $table->string('destination_country');
            $table->date('departure_date');
            $table->string('seat_number');
            $table->date('purchase_date');
            $table->time('purchase_time');
            $table->string('booking_status');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->text('special_requests')->nullable();
            $table->boolean('is_active');
            $table->text('note')->nullable();
            $table->integer('sale')->nullable()->default(0); // Make the sale column nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};