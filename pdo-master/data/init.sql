CREATE DATABASE tapnordic_db;

use tapnordic_db;

CREATE TABLE campaign (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	campaign_name VARCHAR(30) NOT NULL,
	car_model VARCHAR(30) NOT NULL,
	client VARCHAR(50) NOT NULL,
	age INT(3),
	location VARCHAR(50),
	date TIMESTAMP
);