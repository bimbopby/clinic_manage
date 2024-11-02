-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS clinic_management2;
USE clinic_management2;

-- Bảng users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('staff', 'doctor', 'cashier', 'manager', 'nurse') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng register
CREATE TABLE IF NOT EXISTS register (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    dob DATETIME NOT NULL,
    service VARCHAR(100) NOT NULL,
    register_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Bảng record
CREATE TABLE IF NOT EXISTS record (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    service VARCHAR(100) NOT NULL,
    screening BOOLEAN DEFAULT 0,
    screen_time DATETIME DEFAULT NULL,
    doctor VARCHAR(100),
    inject_vaccine BOOLEAN DEFAULT 0,
    time_inject DATETIME DEFAULT NULL
);
CREATE TABLE invoice (
    id INT PRIMARY KEY AUTO_INCREMENT,
    record_id INT,
    cashier_id INT,
    FOREIGN KEY (record_id) REFERENCES record(id),
    FOREIGN KEY (cashier_id) REFERENCES users(id)
);