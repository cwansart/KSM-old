DROP TABLE IF EXISTS animals;

CREATE TABLE animals (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    race_id INT NOT NULL,
    color VARCHAR(50) NOT NULL,
    birth_date VARCHAR(50), -- can be vague, that's why we have a varchar
    is_male BOOLEAN DEFAULT 1,

    is_castrated BOOLEAN NOT NULL DEFAULT 0,
    castration_date TIMESTAMP,

    first_vaccination TIMESTAMP,
    second_vaccination TIMESTAMP ,
    next_vaccination TIMESTAMP,

    tattoo_left VARCHAR(5),
    tattoo_right VARCHAR(5),
    chip INT(15),

    distinguishing_marks TEXT,
    comments TEXT,

    location_id INT,

    is_dead BOOLEAN NOT NULL DEFAULT 0,
    cause_of_death VARCHAR(100),

    is_indoor_cat BOOLEAN NOT NULL DEFAULT 0,
    is_outdoor_cat BOOLEAN NOT NULL DEFAULT 1,
    is_dog_friendly BOOLEAN NOT NULL DEFAULT 1,
    is_child_friendly BOOLEAN NOT NULL DEFAULT 1,

    image_path VARCHAR(150),

    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (race_id) REFERENCES races(id),
    FOREIGN KEY (location_id) REFERENCES locations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;