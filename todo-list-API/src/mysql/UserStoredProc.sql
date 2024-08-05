delimiter //

CREATE PROCEDURE spUser_GetAll()
BEGIN
    SELECT user_id, username, email 
    FROM Users;
END//

CREATE PROCEDURE spUser_Get(IN _user_id INT)
BEGIN
    SELECT *
    FROM Users
    WHERE user_id = _user_id;
END//

CREATE PROCEDURE spUser_Insert(IN _username VARCHAR(50), IN _email VARCHAR(255), IN _pwd VARCHAR(50))
BEGIN
    INSERT INTO Users (username, email, pwd)
    VALUES (_username, _email, _pwd);
END//

CREATE PROCEDURE spUser_Delete(IN _user_id INT)
BEGIN
    DELETE
    FROM Users
    WHERE user_id = _user_id;
END//

CREATE PROCEDURE spUser_Update(IN _user_id INT, IN _username VARCHAR(50), IN _email VARCHAR(255), IN _pwd VARCHAR(50))
BEGIN
    UPDATE Users
    SET username = _username, email = _email, pwd = _pwd
    WHERE user_id = _user_id;
END//

delimiter ;