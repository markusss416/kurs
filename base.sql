CREATE TABLE `avia`.`flight` (
  `id` INT NOT NULL,
  `type_id` VARCHAR(45) NULL,
  `user_id` VARCHAR(45) NULL,
  `date_flight` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


CREATE TABLE `avia`.`flight_type` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE `avia`.`users` (
  `id` INT NOT NULL,
  `login` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
  
ALTER TABLE flight
ADD FOREIGN KEY (type_id) References flight_type (ID)

ALTER Table flight
ADD FOREIGN KEY (user_id) 
REFERENCES users(id)

INSERT INTO `flight` (`id`, `type_id`, `user_id`, `date_flight`, `status`) VALUES
(4, 2, 2, '2023-05-12', 1),
(5, 11, 3, '2023-05-21', 0),
(6, 7, 3, '2023-06-11', 0),
(7, 2, 4, '2023-06-02', 1),
(8, 14, 4, '2023-06-11', 0),
(9, 12, 5, '2023-06-08', 0),
(10, 7, 5, '2023-06-07', 1);


INSERT INTO `flight_type` (`id`, `name`) VALUES
(2, 'Львів - Одесса'),
(5, 'Харків - Одесса'),
(7, 'Київ - Дніпро'),
(8, 'Харків - Одесса'),
(10, 'Дніпро - Львів'),
(11, 'Дніпро - Харків'),
(12, 'Київ - Запоріжжя'),
(13, 'Львів - Запоріжжя'),
(14, 'Харків - Запоріжжя');


INSERT INTO `users` (`id`, `login`, `name`, `surname`, `phone`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'none', '1234'),
(2, 'Bohdan', 'Bohdan', 'Boiko', '+380983737885', '1234'),
(3, 'vasyl', 'Василь', 'Бондаренко', '+380953232655', '1234'),
(4, 'olena', 'Olena', 'Vakula', '+380985252568', '1234'),
(5, 'maria', 'Марія', 'Гончаренко', '+380505478354', '1234');