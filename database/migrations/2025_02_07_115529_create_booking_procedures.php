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
            DROP PROCEDURE IF EXISTS GetAllBookings;
            CREATE PROCEDURE GetAllBookings()
            BEGIN
                SELECT
                    b.id AS booking_id,
                    c.id AS customer_id,
                    CONCAT(p.first_name, " ", p.last_name) AS customer_name,
                    t.id AS travel_id,
                    b.seat_number,
                    b.purchase_date,
                    b.purchase_time,
                    b.booking_status,
                    b.price,
                    b.quantity,
                    b.special_requests,
                    b.is_active,
                    b.note,
                    b.created_at,
                    b.updated_at
                FROM
                    bookings b
                JOIN
                    customers c ON b.customer_id = c.id
                JOIN
                    travels t ON b.travel_id = t.id
                JOIN
                    persons p ON c.persons_id = p.id;
            END
        ');

        DB::unprepared('
            DROP PROCEDURE IF EXISTS GetBookingById;
            CREATE PROCEDURE GetBookingById(IN bookingId INT)
            BEGIN
                SELECT
                    b.id AS booking_id,
                    c.id AS customer_id,
                    CONCAT(p.first_name, " ", p.last_name) AS customer_name,
                    t.id AS travel_id,
                    b.seat_number,
                    b.purchase_date,
                    b.purchase_time,
                    b.booking_status,
                    b.price,
                    b.quantity,
                    b.special_requests,
                    b.is_active,
                    b.note,
                    b.created_at,
                    b.updated_at
                FROM
                    bookings b
                JOIN
                    customers c ON b.customer_id = c.id
                JOIN
                    travels t ON b.travel_id = t.id
                JOIN
                    persons p ON c.persons_id = p.id
                WHERE
                    b.id = bookingId;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetAllBookings');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetBookingById');
    }
};
