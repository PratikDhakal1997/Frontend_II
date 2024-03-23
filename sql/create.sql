CREATE DATABASE example_db;

USE example_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    address TEXT,
    postal_code VARCHAR(20),
    dob DATE,
    gender ENUM('male', 'female', 'other') NOT NULL
);
