CREATE PROCEDURE spDeleteCustomer(IN customerId INT)
BEGIN
    DELETE FROM customers WHERE persons_id = customerId;
END;
