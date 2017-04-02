CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL UNIQUE,
  password BINARY(60) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (
    name,
    password
) VALUES (
    'root',
    '$2y$10$.YBmryTd851HCfIz1bPzEuk9db85ySJJTW18pg9qGtlAPh4zV980K'
    -- Change this password!
);