CREATE TABLE locations (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    street VARCHAR(30),
    house_number VARCHAR(10), -- we could get a '1a'
    zip_code VARCHAR(10),
    city VARCHAR(30),
    country VARCHAR(60), -- some can by long, like the UK

    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
