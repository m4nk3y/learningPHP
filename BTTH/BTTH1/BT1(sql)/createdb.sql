create database flower_management;

use flower_management;

create table flowers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description text NOT NULL,
    image VARCHAR(255) NOT NULL
);