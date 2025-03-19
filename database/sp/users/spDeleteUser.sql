CREATE PROCEDURE spDeleteUser(
    IN p_user_id INT
)
BEGIN
    DECLARE p_person_id INT;

    -- Get the person_id from the users table
    SELECT person_id INTO p_person_id FROM users WHERE id = p_user_id;

    -- Delete from the users table
    DELETE FROM users WHERE id = p_user_id;

    -- Delete from the persons table
    DELETE FROM persons WHERE id = p_person_id;
END;