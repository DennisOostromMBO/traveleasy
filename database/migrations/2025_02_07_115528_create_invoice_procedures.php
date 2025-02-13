<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS GetInvoices;
            CREATE PROCEDURE GetInvoices()
            BEGIN
                SELECT * FROM invoices;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS GetInvoiceById;
            CREATE PROCEDURE GetInvoiceById(IN invoiceId INT)
            BEGIN
                SELECT * FROM invoices WHERE id = invoiceId;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS GenerateInvoice;
            CREATE PROCEDURE GenerateInvoice(IN bookingId INT)
            BEGIN
                DECLARE totalAmount DECIMAL(10, 2);
                SELECT total_amount INTO totalAmount FROM bookings WHERE id = bookingId;
                INSERT INTO invoices (booking_id, amount, status, created_at, updated_at)
                VALUES (bookingId, totalAmount, "Pending", NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetInvoices');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetInvoiceById');
        DB::unprepared('DROP PROCEDURE IF EXISTS GenerateInvoice');
    }
};
