-- criação da base
CREATE DATABASE biblioteca_app
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- seleção da base
USE biblioteca_app;

-- criação das tabelas;

DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS loans;
DROP TABLE IF EXISTS reservations;

CREATE OR REPLACE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    type ENUM('client', 'admin') DEFAULT 'client',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(13) NOT NULL UNIQUE,
    year_published YEAR NOT NULL,
    quantity INT NOT NULL
)
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

insert into books(title, author, isbn, year_published, quantity)
value ('Senhor da Guerra (Crônicas Saxônicas)', 'Berbard Cornwell', '978-6555872392', 2021, 5);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id bigint(20),
    book_id bigint(20),
    reservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiration_date TIMESTAMP NULL,
    status ENUM('active', 'expired', 'canceled'),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
)
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

CREATE TABLE loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    loan_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    return_date TIMESTAMP NULL,
    returned BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
)
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    rating INT CHECK(rating BETWEEN 1 AND 5),
    comment TEXT,
    rating_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
)
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

delimiter //

CREATE TRIGGER add_48_hours_before_joinning
BEFORE INSERT ON reservations
FOR EACH ROW
BEGIN
    IF NEW.expiration_date IS NULL THEN
        SET NEW.expiration_date = CURRENT_TIMESTAMP + INTERVAL 48 HOUR;
    END IF;
END;//
delimiter ;
