CREATE PROCEDURE spGetAllMessages()
BEGIN
    SELECT 
        c.id,
        c.customer_id,
        c.employee_id,
        c.message,
        c.sent_date,
        c.note,
        CONCAT(p_customer.first_name, ' ', p_customer.last_name) AS customer_name,  
        CONCAT(p_employee.first_name, ' ', p_employee.last_name) AS employee_name
    FROM communications c
    LEFT JOIN customers cu ON c.customer_id = cu.id
    LEFT JOIN persons p_customer ON cu.persons_id = p_customer.id  
    LEFT JOIN employees e ON c.employee_id = e.id
    LEFT JOIN persons p_employee ON e.person_id = p_employee.id  
    WHERE c.is_active = 1;
END;