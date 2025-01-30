CREATE DATABASE IF NOT EXISTS votech;

USE votech;

CREATE TABLE IF NOT EXISTS students(
    id INT(11) AUTO_INCREMENT,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    student_name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    voted VARCHAR(5) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS src_presidents(
    id INT(10) AUTO_INCREMENT,
    candidate_name VARCHAR(20) NOT NULL,
    candidate_img VARCHAR(255) NOT NULL,
    candidate_id INT(10) NOT NULL UNIQUE,
    number_of_votes INT(10) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS admins(
    id INT(11) AUTO_INCREMENT,
    admin_id VARCHAR(20) NOT NULL UNIQUE,
    admin_password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);