-- Create Database
CREATE DATABASE
IF NOT EXISTS accessories_db;
USE accessories_db;

-- Users Table
CREATE TABLE users
(
    id INT
    AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR
    (100),
    email VARCHAR
    (100) UNIQUE,
    password VARCHAR
    (255)
);

    -- Products Table
    CREATE TABLE products
    (
        id INT
        AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR
        (150),
    price INT,
    image VARCHAR
        (255),
    category VARCHAR
        (50),
    description TEXT
);

        -- Cart Table
        CREATE TABLE cart
        (
            id INT
            AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT DEFAULT 1
);

            -- Orders Table
            CREATE TABLE orders
            (
                id INT
                AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount INT,
    payment_id VARCHAR
                (100),
    payment_status VARCHAR
                (50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
                -- Admin table
                CREATE TABLE admin
                (
                    id INT
                    AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR
                    (100) UNIQUE,
        password VARCHAR
                    (255)
    );

                    -- Default admin credentials
                    INSERT INTO admin
                        (email, password)
                    VALUES
                        ('admin@gmail.com', '$2y$10$u1dKJ4p5t3R7G7vM.0uU4eX8Zt1M7yRz4Q5ZQ1xZy5qF9mKJcQZC');

                    -- Sample Data
                    INSERT INTO products
                        (name, price, image, category, description)
                    VALUES
                        ('Gold Plated Bracelet', 799, 'bracelet.jpg', 'Accessories', 'Stylish gold plated bracelet'),
                        ('Silver Necklace', 999, 'necklace.jpg', 'Accessories', 'Elegant silver necklace'),
                        ('Heart Charm', 299, 'heart_charm.jpg', 'Charms', 'Cute heart shaped charm'),
                        ('Star Charm', 349, 'star_charm.jpg', 'Charms', 'Shiny star charm');
