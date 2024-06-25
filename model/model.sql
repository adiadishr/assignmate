create database assignmate;
drop database assignmate;
use assignmate;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_no CHAR(10) NOT NULL UNIQUE
);

CREATE TABLE subjects (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

drop table users;

CREATE TABLE assignments (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    subject_id INT NOT NULL,
    user_id INT NOT NULL,
    priority ENUM('high', 'medium', 'low'),
    assigned_date DATE NOT NULL,
    due_date DATE NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('not_started', 'in_progress', 'completed') DEFAULT 'not_started' NOT NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

drop table assignments;

SELECT * FROM assignments;
SELECT * FROM users;
SELECT * FROM subjects;

delete from assignments where id =1;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    assignment_id INT,
    title VARCHAR(255),
    description TEXT,
    status ENUM('not_started', 'in_progress', 'completed'),
    FOREIGN KEY (assignment_id) REFERENCES assignments(id)
);