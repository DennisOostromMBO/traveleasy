DELIMITER //

CREATE PROCEDURE spGetAllCustomers()
BEGIN
    SELECT 
        p.id AS person_id,
        CONCAT(p.first_name, ' ', COALESCE(p.middle_name, ''), ' ', p.last_name) AS full_name,
        p.date_of_birth,
        p.passport_details,
        CONCAT(c.street_name, ' ', c.house_number, ' ', COALESCE(c.addition, ''), ', ', c.postal_code, ', ', c.city) AS full_address,
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) <= 1 THEN 'Baby'
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 2 AND 3 THEN 'Peuter'
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 4 AND 6 THEN 'Kleuter'
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 7 AND 12 THEN 'Kind'
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 13 AND 18 THEN 'Tiener'
            WHEN TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) BETWEEN 19 AND 64 THEN 'Volwassene'
            ELSE 'Oudere'
        END AS age_category
    FROM 
        persons p
    INNER JOIN 
        customers cu ON p.id = cu.persons_id
    INNER JOIN 
        contacts c ON cu.id = c.customer_id;
END //

DELIMITER ;