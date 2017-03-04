CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` binary(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (
    `name`,
    `password`
) VALUES (
    'root',
    HEX('$2y$10$WDxPBjwAa5V8xcAk.PyZcuUUwx95dgESUsOgh5mS4tK.vYoRSwAuG')
    -- Change this password!
);