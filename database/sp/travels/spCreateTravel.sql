CREATE PROCEDURE spCreateTravel(
    IN p_employee_id INT,
    IN p_departure_id INT,
    IN p_destination_id INT,
    IN p_departure_date DATE,
    IN p_departure_time TIME,
    IN p_arrival_date DATE,
    IN p_arrival_time TIME,
    IN p_travel_status VARCHAR(50),
    IN p_is_active TINYINT
)
BEGIN
    DECLARE new_flight_number VARCHAR(50);

    SELECT CONCAT('TE-', COALESCE(MAX(SUBSTRING_INDEX(flight_number, '-', -1)) + 1, 1))
    INTO new_flight_number
    FROM travels;

    INSERT INTO travels (
        employee_id, departure_id, destination_id, flight_number, 
        departure_date, departure_time, arrival_date, arrival_time, 
        travel_status, is_active, created_at, updated_at
    ) VALUES (
        p_employee_id, p_departure_id, p_destination_id, new_flight_number, 
        p_departure_date, p_departure_time, p_arrival_date, p_arrival_time, 
        p_travel_status, p_is_active, NOW(), NOW()
    );
END;
