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
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->foreignId('travel_id')->constrained('travels')->onDelete('cascade');
                $table->string('seat_number');
                $table->date('purchase_date');
                $table->time('purchase_time');
                $table->string('booking_status');
                $table->decimal('price', 8, 2);
                $table->integer('quantity');
                $table->text('special_requests')->nullable();
                $table->boolean('is_active');
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->decimal('amount_excl_vat', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('amount_incl_vat', 8, 2);
            $table->string('invoice_status');
            $table->boolean('is_active');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
