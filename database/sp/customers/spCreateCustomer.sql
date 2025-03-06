CREATE PROCEDURE spCreateCustomer(
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
    DECLARE new_person_id INT;
    DECLARE new_customer_id INT;
    DECLARE next_number INT;

    START TRANSACTION;

    -- Get next relation number (fixed the query to maintain sequence)
    SELECT COALESCE(MAX(CAST(SUBSTRING(relation_number, 4) AS UNSIGNED)), 0) + 1
    INTO next_number
    FROM customers
    WHERE relation_number LIKE 'TE-%';

    -- Insert person
    INSERT INTO persons (
        first_name, 
        middle_name, 
        last_name, 
        date_of_birth, 
        passport_details,
        is_active,
        created_at,
        updated_at
    ) VALUES (
        p_first_name, 
        p_middle_name, 
        p_last_name, 
        p_date_of_birth, 
        p_passport_details,
        1,
        NOW(),
        NOW()
    );
    
    SET new_person_id = LAST_INSERT_ID();

    -- Insert customer
    INSERT INTO customers (
        persons_id, 
        relation_number, 
        is_active,
        created_at,
        updated_at
    ) VALUES (
        new_person_id, 
        CONCAT('TE-', LPAD(next_number, 5, '0')), 
        1,
        NOW(),
        NOW()
    );
    
    SET new_customer_id = LAST_INSERT_ID();

    -- Insert contact
    INSERT INTO contacts (
        customer_id, 
        street_name, 
        house_number, 
        addition, 
        postal_code, 
        city, 
        mobile, 
        email, 
        is_active,
        created_at,
        updated_at
    ) VALUES (
        new_customer_id, 
        p_street_name, 
        p_house_number, 
        p_addition, 
        p_postal_code, 
        p_city, 
        p_mobile, 
        p_email, 
        1,
        NOW(),
        NOW()
    );

    COMMIT;
END
