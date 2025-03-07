CREATE PROCEDURE spGetAllRoles()
BEGIN
    SELECT id, name FROM roles ORDER BY name;
END;