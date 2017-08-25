CREATE TABLE `users` (
	`id` int(11) NOT NULL,
	`email` varchar(255) DEFAULT NULL,
	`password` varchar(255) DEFAULT NULL,
	`level` enum('admin', 'user') NOT NULL,
	`access` tinyint(4) NOT NULL,
	`registrationDate` int(11) NOT NULL,
	`code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;