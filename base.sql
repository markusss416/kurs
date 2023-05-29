-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 26 2023 р., 20:51
-- Версія сервера: 8.0.24
-- Версія PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--CREATE DATABASE IF NOT EXISTS `avia1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `avia1`;
-- База даних: `avia1`
--

-- --------------------------------------------------------

--
-- Структура таблиці `flight`
--

CREATE TABLE `flight` (
  `id` int NOT NULL,
  `type_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_flight` date NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `flight`
--

INSERT INTO `flight` (`id`, `type_id`, `user_id`, `date_flight`, `status`) VALUES
(4, 2, 2, '2023-05-12', 1),
(5, 11, 3, '2023-05-21', 0),
(6, 7, 3, '2023-06-11', 0),
(7, 2, 4, '2023-06-02', 1),
(8, 14, 4, '2023-06-11', 0),
(9, 12, 5, '2023-06-08', 0),
(10, 7, 5, '2023-06-07', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `flight_type`
--

CREATE TABLE `flight_type` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `flight_type`
--

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

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `surname`, `phone`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'none', '1234'),
(2, 'Bohdan', 'Bohdan', 'Boiko', '+380983737885', '1234'),
(3, 'vasyl', 'Василь', 'Бондаренко', '+380953232655', '1234'),
(4, 'olena', 'Olena', 'Vakula', '+380985252568', '1234'),
(5, 'maria', 'Марія', 'Гончаренко', '+380505478354', '1234');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `flight_type`
--
ALTER TABLE `flight_type`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `flight_type`
--
ALTER TABLE `flight_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

ALTER TABLE flight
ADD CONSTRAINT fk_flight_type
FOREIGN KEY (type_id)
REFERENCES flight_type(id);

ALTER TABLE flight
ADD CONSTRAINT fk_users
FOREIGN KEY (user_id)
REFERENCES users(id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
