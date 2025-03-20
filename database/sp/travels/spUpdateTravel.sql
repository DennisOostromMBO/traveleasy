CREATE PROCEDURE spUpdateTravel(
    IN p_travel_id INT,
    IN p_employee_id INT,
    IN p_departure_id INT,
    IN p_destination_id INT,
    IN p_flight_number VARCHAR(50),
    IN p_departure_date DATE,
    IN p_departure_time TIME,
    IN p_arrival_date DATE,
    IN p_arrival_time TIME,
    IN p_travel_status VARCHAR(50),
    IN p_is_active TINYINT
)
BEGIN
    UPDATE travels
    SET 
        employee_id = p_employee_id,
        departure_id = p_departure_id,
        destination_id = p_destination_id,
        flight_number = p_flight_number,
        departure_date = p_departure_date,
        departure_time = p_departure_time,
        arrival_date = p_arrival_date,
        arrival_time = p_arrival_time,
        travel_status = p_travel_status,
        is_active = p_is_active,
        updated_at = NOW()
    WHERE id = p_travel_id;
END;
