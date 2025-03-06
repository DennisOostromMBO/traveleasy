CREATE PROCEDURE spUpdateCustomer(
    IN p_person_id INT,
    IN p_first_name VARCHAR(255),
    IN p_middle_name VARCHAR(255),
    IN p_last_name VARCHAR(255),
    IN p_date_of_birth DATE,
    IN p_passport_details VARCHAR(255),
    IN p_street_name VARCHAR(255),
    IN p_house_number VARCHAR(10),
    IN p_addition VARCHAR(10),
    IN p_postal_code VARCHAR(10),
    IN p_city VARCHAR(255),
    IN p_mobile VARCHAR(20),
    IN p_email VARCHAR(255)
)
BEGIN
    -- Update persons table
    UPDATE persons 
    SET 
        first_name = p_first_name,
        middle_name = p_middle_name,
        last_name = p_last_name,
        date_of_birth = p_date_of_birth,
        passport_details = p_passport_details
    WHERE id = p_person_id;

    -- Update contacts table
    UPDATE contacts c
    INNER JOIN customers cu ON c.customer_id = cu.id
    SET 
        c.street_name = p_street_name,
        c.house_number = p_house_number,
        c.addition = p_addition,
        c.postal_code = p_postal_code,
        c.city = p_city,
        c.mobile = p_mobile,
        c.email = p_email
    WHERE cu.persons_id = p_person_id;
END;
