CREATE DATABASE btvn;

USE btvn;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenSP VARCHAR(255) NOT NULL,
    giaThanh FLOAT NOT NULL
);