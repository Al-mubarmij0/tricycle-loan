-- Create the database
CREATE DATABASE IF NOT EXISTS tricycle_db;
USE tricycle_db;

-- 1. Users (Riders)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    nin VARCHAR(20) NOT NULL,
    bvn VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 2. Tricycles
CREATE TABLE tricycles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plate_no VARCHAR(50) NOT NULL UNIQUE,
    model VARCHAR(100) NOT NULL,
    status ENUM('available', 'on_rent', 'maintenance') DEFAULT 'available'
);

-- 3. Rental Durations and Prices
CREATE TABLE rental_durations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL,               -- e.g. "1 Hour"
    duration_minutes INT NOT NULL,            -- e.g. 60
    price DECIMAL(10, 2) NOT NULL             -- e.g. 1500.00
);

-- 4. Rental Requests
CREATE TABLE rental_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tricycle_id INT NOT NULL,
    rental_duration_id INT NOT NULL,
    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    return_status ENUM('none', 'return_pending', 'returned') DEFAULT 'none',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tricycle_id) REFERENCES tricycles(id) ON DELETE CASCADE,
    FOREIGN KEY (rental_duration_id) REFERENCES rental_durations(id) ON DELETE CASCADE
);
