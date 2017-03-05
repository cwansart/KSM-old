CREATE TABLE `sessions` (
  `user_id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`user_id`, `session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
