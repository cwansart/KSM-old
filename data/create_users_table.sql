CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL UNIQUE,
  `password` binary(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (
    `name`,
    `password`
) VALUES (
    'root',
    '$2y$10$.YBmryTd851HCfIz1bPzEuk9db85ySJJTW18pg9qGtlAPh4zV980K'
    -- Change this password!
);