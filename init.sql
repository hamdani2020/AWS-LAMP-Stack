CREATE DATABASE IF NOT EXISTS registration;
USE registration;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    programme VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    contact VARCHAR(15) NOT NULL,
    number VARCHAR(8) NOT NULL
);

