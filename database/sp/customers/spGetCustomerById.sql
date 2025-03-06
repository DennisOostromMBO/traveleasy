CREATE PROCEDURE spGetCustomerById(IN customerId INT)
BEGIN
    SELECT 
        p.id AS person_id,
        p.first_name,
        p.middle_name,
        p.last_name,
        p.date_of_birth,
        p.passport_details,
        c.street_name,
        c.house_number,
        c.addition,
        c.postal_code,
        c.city,
        c.mobile,
        c.email,
        cu.relation_number
    FROM 
        persons p
    INNER JOIN 
        customers cu ON p.id = cu.persons_id
    INNER JOIN 
        contacts c ON cu.id = c.customer_id
    WHERE 
        p.id = customerId;
END;
