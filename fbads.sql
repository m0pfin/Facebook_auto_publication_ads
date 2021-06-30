-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июн 30 2021 г., 18:06
-- Версия сервера: 5.7.30
-- Версия PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fbads`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `adtrust_dsl` bigint(20) DEFAULT NULL,
  `pages` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `proxy_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `token`, `adtrust_dsl`, `pages`, `status`, `user_id`, `user_name`, `proxy_id`) VALUES
(66, 'hype-auto-1', 'EAABsbCS1iHgBADOIWxQZB14ECkOiWyLUr8VBV6Jvcwpf1ldQs7cS6A1sZC3LokZCPZB1j2glRwYNM7ORcuRhvhXMkUmDP0dEyEzLdOIYwXK8KW6SOZC8sjKdGTOXtmIlLZCkXFAmAG9Nu3VVu9KZAHkHaSGE8kAyqqpEgmXPGjlOJgZBbsZAUVFhY', 0, 0, 1, 0, '0', 7),
(67, 'Autoreg - hyperloob', 'EAABsbCS1iHgBANPG6PnDS6QZByHDTQhfeG64oVvCVlRITRaVcZCTArrUyiFu8gDu5x3rHN7mcpJkVD5xkGvoPV2aQgl855rwksowMTCYBOPFig7eMePkFQSZCVaCSiuACXVdveKwZAZCofAM7Bk865PlJJav2NqK0QmRHZB9ZBHk77kqgivHJZBLNCz2jruR3ZBkZD', 0, 0, 1, 0, '0', 8),
(68, 'Акк_леха1', 'EAABsbCS1iHgBAMjtIlUeYkRjlMSes3C85TZAgFe6ZAcjR05decDh6iJEhkRL930O3geuicC7xkTA83cTFR093pZCFOnMbyQ8g5Dwg2Gt7qe1vJg6ZCEQxZCQZBAI1q789ywBElnyOa87guzyR4BgVYD1IZCiO0TWAnEigv7hvhvFOgddc7rfZAlk', 0, 102545645422570, 0, 100069414271867, 'Arminda Azcona', 1),
(69, 'Акк_леха2', 'EAABsbCS1iHgBABrZC1RQ7rec8dtfhAeJthkvfWxaLu1c47GYpKDrK3TACxZBiFmiPZBILnix5KXFWexIs65RWeYkr5ZB4jx3T7tZA8paJgTGjICZCEAg0L8A3QBQlLQDylmhW1cFoHfwo6oWyZA7dsxDboZAKnfRm2o5VKiaoUSAtXn9Aqo146kxZAylf70SqswUZD', 0, 106870394983260, 0, 100068910835367, 'Донат Громов', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `ad_account`
--

CREATE TABLE `ad_account` (
  `id` int(11) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pixel_id` bigint(150) DEFAULT NULL,
  `adtrust_dsl` int(150) DEFAULT NULL,
  `billing` int(150) DEFAULT NULL,
  `amount` int(150) DEFAULT NULL,
  `adaccount_id` varchar(255) DEFAULT NULL,
  `account_status` int(11) DEFAULT NULL,
  `disable_reason` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ad_account`
--

INSERT INTO `ad_account` (`id`, `accounts_id`, `name`, `pixel_id`, `adtrust_dsl`, `billing`, `amount`, `adaccount_id`, `account_status`, `disable_reason`) VALUES
(1, 69, 'Донат Громов', 0, 25, 2, 0, 'act_195156472493942', 1, 0),
(2, 68, 'Arminda Azcona', 0, 1832, 1250, 1200, 'act_944883203016158', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `cardNumber` bigint(20) NOT NULL,
  `moth` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `cvv` int(11) NOT NULL,
  `count` int(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cards`
--

INSERT INTO `cards` (`id`, `cardNumber`, `moth`, `year`, `cvv`, `count`) VALUES
(1, 5536109890385433, 12, 2021, 134, 0),
(2, 4422111144446666, 11, 2023, 340, 0),
(3, 9199111122229999, 20, 2020, 139, 0),
(4, 9999111199992222, 9, 2020, 299, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `preset`
--

CREATE TABLE `preset` (
  `id` int(11) NOT NULL,
  `name_campaign` varchar(255) NOT NULL,
  `status_campaign` int(11) NOT NULL,
  `objective` int(11) NOT NULL,
  `name_adset` varchar(255) NOT NULL,
  `daily_budget_adset` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` int(11) NOT NULL,
  `bid_strategy` int(11) NOT NULL,
  `billing_event` int(11) NOT NULL,
  `optimization_goal` int(11) NOT NULL,
  `custom_event_type` int(11) NOT NULL,
  `targeting_geo_countries` varchar(255) NOT NULL,
  `publisher_platforms` text NOT NULL,
  `device_platforms` int(11) NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `status_adset` int(11) NOT NULL,
  `name_ad` varchar(255) NOT NULL,
  `body_ad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `preset`
--

INSERT INTO `preset` (`id`, `name_campaign`, `status_campaign`, `objective`, `name_adset`, `daily_budget_adset`, `start_time`, `end_time`, `bid_strategy`, `billing_event`, `optimization_goal`, `custom_event_type`, `targeting_geo_countries`, `publisher_platforms`, `device_platforms`, `age_min`, `age_max`, `gender`, `status_adset`, `name_ad`, `body_ad`) VALUES
(1, 'Кампания_1', 0, 0, 'Adset_test', 5000, '2020-04-17T22:23:07+0300', 0, 0, 0, 0, 0, 'FR', '0', 0, 25, 65, 0, 0, 'Ad test', 'Текстовое сообщение 1'),
(58, 'Тестовая кампания', 1, 0, 'Тестовый адсет', 100, '2020-04-17T22:23:07-0700', 0, 0, 0, 0, 0, 'RU', '0', 2, 28, 65, 2, 0, 'ЛЕНТА', 'Успейте получить скидку 50% на все товары ЛЕНТА!\r\nАнтикризисное предложение\r\nУзнайте подробнее >>'),
(59, 'Проверка 24/06/2021', 0, 0, 'Суета', 500, '2020-04-17T22:23:07-0700', 0, 0, 0, 0, 0, 'RU', '0', 0, 34, 62, 1, 0, 'Сидор', 'Молодец');

-- --------------------------------------------------------

--
-- Структура таблицы `proxy`
--

CREATE TABLE `proxy` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `port` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `proxy`
--

INSERT INTO `proxy` (`id`, `ip`, `port`, `login`, `pass`) VALUES
(10, '91.224.155.1', 50029, 'login', 'paasss');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ad_account`
--
ALTER TABLE `ad_account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `preset`
--
ALTER TABLE `preset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `proxy`
--
ALTER TABLE `proxy`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `ad_account`
--
ALTER TABLE `ad_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT для таблицы `preset`
--
ALTER TABLE `preset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `proxy`
--
ALTER TABLE `proxy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
