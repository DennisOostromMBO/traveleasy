CREATE PROCEDURE spGetAllBookings()
BEGIN
    SELECT 
        b.id AS booking_id,
        c.id AS customer_id,
        CONCAT(p.first_name, ' ', p.last_name) AS customer_name,
        t.id AS travel_id,
        d1.country AS departure_country,
        d2.country AS destination_country,
        t.departure_date,
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
    JOIN
        departures d1 ON t.departure_id = d1.id
    JOIN
        destinations d2 ON t.destination_id = d2.id;
END;

