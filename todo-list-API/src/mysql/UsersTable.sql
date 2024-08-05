CREATE TABLE IF NOT EXISTS Users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(50) NOT NULL,
    PRIMARY KEY (user_id)
);

INSERT INTO Users (user_id, username, email, pwd)
VALUES (1, 'test_user1', 'user1@gmail.com', 'hash1'),
    (2, 'test_user2', 'user2@gmail.com', 'hash2'),
    (3, 'test_user3', 'user3@gmail.com', 'hash3'),
    (4, 'test_user4', 'user4@gmail.com', 'hash4');