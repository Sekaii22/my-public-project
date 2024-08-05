CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT NOT NULL AUTO_INCREMENT,
    task_name VARCHAR(255) NOT NULL,
    task_description TEXT,
    is_completed BOOLEAN NOT NULL,
    completion_date DATE,
    user_id INT NOT NULL,
    PRIMARY KEY (task_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

INSERT INTO Tasks (task_id, task_name, task_description, is_completed, completion_date, user_id)
VALUES (1, 'Buy groceries', 'apples, banana, milk, bread, cereal', true, '2024-04-17', 1),
    (2, 'Fetch the kids after school', NULL, false, NULL, 2),
    (3, 'Game night with friends', '8pm on friday this week', false, NULL, 3),
    (4, 'Math homework', 'due 20 april 2359hr', false, NULL, 4);