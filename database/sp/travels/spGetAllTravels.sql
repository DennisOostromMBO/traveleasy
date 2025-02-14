BEGIN
    SELECT 
        t.id AS travel_id,
        e.id AS employee_id,
        CONCAT(p.first_name, ' ', p.last_name) AS employee_name,
        d1.country AS departure_country,
        d1.airport AS departure_airport,
        d2.country AS destination_country,
        d2.airport AS destination_airport,
        t.flight_number,
        t.departure_date,
        t.departure_time,
        t.arrival_date,
        t.arrival_time,
        t.travel_status,
        t.is_active,
        t.note,
        t.created_at,
        t.updated_at
    FROM travels t
    JOIN employees e ON t.employee_id = e.id
    JOIN persons p ON e.person_id = p.id
    JOIN departures d1 ON t.departure_id = d1.id
    JOIN destinations d2 ON t.destination_id = d2.id;
END