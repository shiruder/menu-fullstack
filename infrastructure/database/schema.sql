SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
USE sales;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
 `id` int(10) NOT NULL,
 `user_id` int(10) NOT NULL,
 `value` DECIMAL(8,2) NOT NULL,
 `status` ENUM('Novo', 'Entregue', 'Pendente') NOT NULL,
 `date` datetime NOT NULL,
 `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



INSERT INTO `orders` (`id`, `user_id`, `value`, `status`, `date`, `created_at`) VALUES
(1, 1, 140.99, 'Novo', '2020-02-03 01:00:00', NOW()),
(2, 2, 120.75, 'Entregue', '2020-02-03 01:00:00', NOW()),
(3, 3, 1145.00, 'Pendente', '2020-02-02 01:00:00', NOW()),
(4, 4, 4050.99, 'Pendente', '2020-02-05 01:00:00', NOW()),
(5, 5, 37890.00, 'Novo', '2020-01-30 01:00:00', NOW());


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
 `id` int(10) NOT NULL,
 `first_name` varchar(32) NOT NULL,
 `last_name` varchar(64) NOT NULL,
 `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
(1, 'Manuela', 'da Silva', 'manuela@example.com'),
(2, 'Leonor', 'Caetano', 'leonor@example.com'),
(3, 'Marcos', 'Pimentel', 'marcos@example.com'),
(4, 'Joana', 'Alves', 'joana@example.com'),
(5, 'Enzo', 'Lorenzo', 'enzo@example.com');

ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`),
 ADD KEY `user_id` (`user_id`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
 MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

ALTER TABLE `users`
 MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;