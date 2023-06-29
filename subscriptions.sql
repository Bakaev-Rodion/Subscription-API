-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 29 2023 г., 20:41
-- Версия сервера: 8.0.29
-- Версия PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `subscriptions`
--

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `payment_id` varchar(32) NOT NULL,
  `token` varchar(32) NOT NULL,
  `payerID` varchar(32) NOT NULL,
  `user_id` int NOT NULL,
  `sub_id` int NOT NULL,
  `cost` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `token`, `payerID`, `user_id`, `sub_id`, `cost`, `date`) VALUES
(2, 'PAYID-MSOZWGY7L677151BE9747249', 'EC-75U866430E383630T', 'PXWPNS5FV3PEG', 2, 3, 15, '2023-06-29'),
(3, 'PAYID-MSOZ2YA6TK30685HR604114H', 'EC-1KC963253N4631347', 'PXWPNS5FV3PEG', 2, 3, 15, '2023-06-29');

-- --------------------------------------------------------

--
-- Структура таблицы `publications`
--

CREATE TABLE `publications` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `publications`
--

INSERT INTO `publications` (`id`, `user_id`, `title`, `text`) VALUES
(5, 1, 'Title of my new publication', 'Some very important text');

-- --------------------------------------------------------

--
-- Структура таблицы `subs`
--

CREATE TABLE `subs` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `cost` float NOT NULL,
  `publications` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `subs`
--

INSERT INTO `subs` (`id`, `name`, `cost`, `publications`, `active`) VALUES
(1, 'Admin', 0, 99999, 1),
(8, 'HugeVery', 50, 1000, 1),
(11, 'New new new', 1000, 3000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `jwt` varchar(255) NOT NULL,
  `active_sub` int DEFAULT NULL,
  `publications_left` int DEFAULT NULL,
  `bought_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `jwt`, `active_sub`, `publications_left`, `bought_at`) VALUES
(1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbiIsInBhc3N3b3JkIjoicXdlcnR5IiwiYWRtaW4iOnRydWV9.Hq_Au9TMC_WdAsBQHAdlMx3l3Hzht83pEKmg7cEahls', 1, 99998, '2023-06-29'),
(2, 'Rodion', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwidXNlcm5hbWUiOiJSb2Rpb24iLCJwYXNzd29yZCI6InF3ZXJ0eSIsImFkbWluIjpmYWxzZX0.HSKFjurCJZQZ0RGzuj-Fdv80TXSvBlNR0E8kIfhz4hs', 3, 500, '2023-06-29');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active_sub` (`active_sub`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `subs`
--
ALTER TABLE `subs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
