-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2023 г., 23:43
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dandyou`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id_appointment` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id_appointment`, `user_id`, `service_id`, `appointment_date`, `appointment_time`) VALUES
(20, 53, 1, '2023-11-02', '14:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id_services` int NOT NULL,
  `name_services` varchar(255) DEFAULT NULL,
  `price_services` varchar(255) DEFAULT NULL,
  `info_services` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `details_services` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `term_services` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo-services` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id_services`, `name_services`, `price_services`, `info_services`, `details_services`, `term_services`, `photo-services`) VALUES
(1, 'Консультация по дизайну квартиры', '15.000 ₽/час', 'Детальный альбом строительной документации,\r\nсложных проектных узлов и фотореалистичных 3D-\r\nВизуализаций. В проект включены чертежи мебели\r\nи других заказных позиций, а также список\r\nматериалов и мебели без указания цены.', '- Планировочное решение\r\n- 3D-визуализации\r\n- Рабочая документация\r\n- Проекты мебельных изделий\r\n- Адаптация под проекты смежных подрядчиков\r\n- Список материалов и мебели, используемых в проекте', 'От 3 месяцев с учётом ваших редакций', ''),
(2, 'Консультация по дизайну дома', '35.000 ₽/час', 'Берём на себя управление вашим\r\nремонтом: мы считаем смету,\r\nподбираем строителей, закупаем\r\nматериал вместе с вами,\r\nконтролируем этапность стройки, и\r\nсроки поставок чистовых материалов и мебели. В стоимость входит декоратор и независимый технический надзор.', '', '', ''),
(6, 'Консультация по дизайну коммерческих помещений ', '50.000 ₽/час', 'Решаем все вопросы по поиску, закупке и доставке материалов: составляем смету на чистовые материалы и мебель, финансовый план и календарь поставок, выставляем коммерческие предложения и счета. Берем на себя координацию строителей и поставщиков.', '', '', ''),
(7, 'Консультация по планировке', '25.000 ₽/час', 'Разберем планировки объектов для потенциальной покупки относительно ваших запросов. Выясним какой объект вам подойдет больше.', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `specialist`
--

CREATE TABLE `specialist` (
  `id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `specialist`
--

INSERT INTO `specialist` (`id`, `full_name`, `specialization`, `photo`) VALUES
(1, 'ТАТЬЯНА ГАВРИЛЕНКО', 'ГИП', 'media/photo_robotnik/1.jpg'),
(2, 'АЛЕКСАНДР ЖУРАВЛЕВ', 'Визуализатор', 'media/photo_robotnik/2.jpg'),
(3, 'ДАРЬЯ СЕДЕЛКИНА', 'Ведущий дизайнер', 'media/photo_robotnik/4.jpg'),
(4, 'ИРИНА ЛУГИНА', 'Проектировщик', 'media/photo_robotnik/3.jpg'),
(5, 'СЕРГЕЙ ГАЗМАНОВ', 'Дизайнер интерьера', 'media/photo_robotnik/5.jpg'),
(6, 'ВАЛЕРИЯ ТАБОЛА', 'Дизайнер интерьера ', 'media/photo_robotnik/6.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Login`, `Email`, `Password`) VALUES
(52, 'Малышев Урсултан Андреевич ', 'Urus', 'maliUrs@gmile.com', '$2y$10$5szOtFZi0B2RlgTykUQUlOd8EVFr1uja.btt3NEx177iGkqQU0ok2'),
(53, 'Пушин Андрей Павлович', 'andpusPuf', 'andpusPuf@gmail.com', '$2y$10$WGwFXuIavqoHrlQtoSPsLOIM6vA0zYDjadr4Fc.kwUcp7.MVuhAui'),
(55, 'qwe', 'qwe', 'qwe@gmail.com', '$2y$10$70pqAeuLv9ALRWTFtIX.We12geElJ9ShsNKM.qgsElOnAir90rOVy'),
(56, 'asd', 'asd', 'asd@asdAsd', '$2y$10$AUMeIywxOFwn33EkLEfn.egGSeQAf3yRAL9tgIIYIqQQpKJGUxfiO'),
(57, 'zxc', 'zxc', 'zxc@zxc', '$2y$10$JDMl3g1jTyoaBXMFE4eAVeK7i7hCJf4Iq2ESqooV8mj.0.8M8hvDe');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id_appointment`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_services`);

--
-- Индексы таблицы `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Login` (`Login`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id_appointment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id_services` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id_services`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
