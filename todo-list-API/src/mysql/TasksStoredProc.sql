delimiter //

CREATE PROCEDURE spTask_GetAll(IN _user_id INT)
BEGIN
    SELECT * 
    FROM Tasks
    WHERE user_id = _user_id;
END//

CREATE PROCEDURE spTask_Get(IN _task_id INT)
BEGIN
    SELECT *
    FROM Tasks
    WHERE task_id = _task_id;
END//

CREATE PROCEDURE spTask_Delete(IN _task_id INT)
BEGIN
    DELETE
    FROM Tasks
    WHERE task_id = _task_id;
END//

CREATE PROCEDURE spTask_Insert(IN _task_name VARCHAR(255), IN _task_description TEXT, IN _is_completed BOOLEAN, IN _user_id INT)
BEGIN
    INSERT INTO Tasks (task_name, task_description, is_completed, user_id)
    VALUES (_task_name, _task_description, _is_completed, _user_id);
END//

CREATE PROCEDURE spTask_Update(IN _task_id INT, IN _task_name VARCHAR(255), IN _task_description TEXT, IN _is_completed BOOLEAN, IN _completion_date DATE)
BEGIN
    UPDATE Tasks
    SET task_name = _task_name, task_description = _task_description, is_completed = _is_completed, completion_date = _completion_date
    WHERE task_id = _task_id;
END//

delimiter ;