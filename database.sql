CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) DEFAULT NULL,
	`password` varchar(255) DEFAULT NULL,
	`level` enum('admin', 'user') NOT NULL,
	`access` tinyint(4) NOT NULL,
	`registrationDate` int(11) NOT NULL,
	`code` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `password`, `level`, `access`, `registrationDate`, `code`) VALUES
(1, 'admin@test.ru', 'b59c67bf196a4758191e42f76670ceba', 'admin', 1, 1503304322, '');