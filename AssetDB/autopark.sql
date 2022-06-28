-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 28 2022 г., 11:29
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autopark`
--

-- --------------------------------------------------------

--
-- Структура таблицы `маршрутный лист`
--

CREATE TABLE `маршрутный лист` (
  `Номер маршрута` int NOT NULL,
  `Количество промежуточных остановок на маршруте` int DEFAULT NULL,
  `Продолжительсноть простоя на одной остановке, мин.` int DEFAULT NULL,
  `Время прохождения маршрута, мин.` int DEFAULT NULL,
  `Стоимость проезда, руб.` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `маршрутный лист`
--

INSERT INTO `маршрутный лист` (`Номер маршрута`, `Количество промежуточных остановок на маршруте`, `Продолжительсноть простоя на одной остановке, мин.`, `Время прохождения маршрута, мин.`, `Стоимость проезда, руб.`) VALUES
(4, 3, 14, 22, 50),
(789, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `парк`
--

CREATE TABLE `парк` (
  `Гаражный номер` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Код автобуса` varchar(20) NOT NULL,
  `Гос.номер` varchar(10) NOT NULL,
  `Год выпуска` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `парк`
--

INSERT INTO `парк` (`Гаражный номер`, `Код автобуса`, `Гос.номер`, `Год выпуска`) VALUES
('456', '123', '456', 456);

-- --------------------------------------------------------

--
-- Структура таблицы `путевой лист`
--

CREATE TABLE `путевой лист` (
  `ID` int NOT NULL,
  `Код автобуса` varchar(20) NOT NULL,
  `Табельный номер водителя` varchar(20) NOT NULL,
  `Номер маршрута` int NOT NULL,
  `Дата` date DEFAULT NULL,
  `Время выхода автобуса на маршрут` varchar(10) NOT NULL,
  `Время прибытия автобуса с маршрута` varchar(10) NOT NULL,
  `Топливо при выезде, л.` int NOT NULL,
  `Топливо при возврате, л.` int NOT NULL,
  `Причина схода автобуса с маршрута` varchar(50) DEFAULT NULL,
  `Количество проданных билетов` int NOT NULL,
  `Выручка, руб.` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Триггеры `путевой лист`
--
DELIMITER $$
CREATE TRIGGER `added_trigger` AFTER INSERT ON `путевой лист` FOR EACH ROW begin
    DECLARE ID1 int;
    DECLARE Code_Bus varchar(20);
    declare Service_number varchar(20);
    declare Statusw varchar(15);
    SET ID1 = new.`ID`;
	set Code_Bus = new.`Код автобуса`;
	set Service_number = new.`Табельный номер водителя`;
	set Statusw = 'В пути';
	insert into `Статистика` values (ID1, Code_Bus, Service_number, Statusw);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `водители`
--

CREATE TABLE `водители` (
  `Табельный номер водителя` varchar(20) NOT NULL,
  `Ф.И.О` varchar(50) NOT NULL,
  `Дата рождения` date DEFAULT NULL,
  `Оклад, руб.` int NOT NULL,
  `Стаж работы, лет.` int NOT NULL,
  `Номер маршрута` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `водители`
--

INSERT INTO `водители` (`Табельный номер водителя`, `Ф.И.О`, `Дата рождения`, `Оклад, руб.`, `Стаж работы, лет.`, `Номер маршрута`) VALUES
('jndfjgn', 'Кожухов Максим Евгеньевич', '2022-06-17', 51000, 44, 789);

-- --------------------------------------------------------

--
-- Структура таблицы `статистика`
--

CREATE TABLE `статистика` (
  `ID` int NOT NULL,
  `Код автобуса` varchar(20) NOT NULL,
  `Табельный номер водителя` varchar(20) NOT NULL,
  `Статус` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `статистика`
--

INSERT INTO `статистика` (`ID`, `Код автобуса`, `Табельный номер водителя`, `Статус`) VALUES
(12, '123123123211', 'jndfjgn', 'В пути');

--
-- Триггеры `статистика`
--
DELIMITER $$
CREATE TRIGGER `deleted_trigger` AFTER DELETE ON `статистика` FOR EACH ROW begin
	update `Путевой лист`
    set `Время прибытия автобуса с маршрута` = CURRENT_TIME()
    where `ID`;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `типы автобусов`
--

CREATE TABLE `типы автобусов` (
  `Код автобуса` varchar(20) NOT NULL,
  `Марка автобуса` varchar(20) NOT NULL,
  `Модель автобуса` varchar(20) NOT NULL,
  `Количество мест` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `типы автобусов`
--

INSERT INTO `типы автобусов` (`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`) VALUES
('123', '123', '123', 123),
('123123123', 'eerser', 'sfsdf', 1224),
('1231231232', 'eerser', 'sfsdf', 1224),
('123123123211', 'eerser', 'sfsdf', 1224),
('1231231232113123', 'eerser', 'sfsdf', 1224),
('77777777777', 'dfgdg', 'dfgdfg', 34345),
('777777777778', 'dfgdg', 'dfgdfg', 34345),
('ваыаыв', 'ываываы', 'ываыва', 22),
('мунананананан', 'апапапап', 'папапапап', 333333),
('Пипка', 'вапвапвап', 'апвпвпвапв', 45),
('Соня ', 'Дурочка', 'Хаха', 2),
('тратата', 'мерседес', 'sprinter', 55),
('трататаgk', 'jhbjh', 'fff', 66),
('у3цфк', 'ваыва', 'вава', 2222),
('уаыуа', 'ываыва', 'ывавыа', 233),
('ываыва', 'выа', 'ыва', 235);

-- --------------------------------------------------------

--
-- Структура таблицы `тех.талоны`
--

CREATE TABLE `тех.талоны` (
  `Номер тех.талона` varchar(20) NOT NULL,
  `Код автобуса` varchar(20) NOT NULL,
  `Дата прохождения ТО` date NOT NULL,
  `Дата следующего ТО` date NOT NULL,
  `Ф.И.О Тех.эксперта` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `тех.талоны`
--

INSERT INTO `тех.талоны` (`Номер тех.талона`, `Код автобуса`, `Дата прохождения ТО`, `Дата следующего ТО`, `Ф.И.О Тех.эксперта`) VALUES
('000', '123', '2022-06-09', '2022-06-11', '123321');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `маршрутный лист`
--
ALTER TABLE `маршрутный лист`
  ADD PRIMARY KEY (`Номер маршрута`);

--
-- Индексы таблицы `парк`
--
ALTER TABLE `парк`
  ADD PRIMARY KEY (`Гаражный номер`),
  ADD KEY `Код автобуса` (`Код автобуса`);

--
-- Индексы таблицы `путевой лист`
--
ALTER TABLE `путевой лист`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Код автобуса` (`Код автобуса`),
  ADD KEY `Табельный номер водителя` (`Табельный номер водителя`),
  ADD KEY `Номер маршрута` (`Номер маршрута`);

--
-- Индексы таблицы `водители`
--
ALTER TABLE `водители`
  ADD PRIMARY KEY (`Табельный номер водителя`),
  ADD KEY `Номер маршрута` (`Номер маршрута`);

--
-- Индексы таблицы `статистика`
--
ALTER TABLE `статистика`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Код автобуса` (`Код автобуса`),
  ADD KEY `Табельный номер водителя` (`Табельный номер водителя`);

--
-- Индексы таблицы `типы автобусов`
--
ALTER TABLE `типы автобусов`
  ADD PRIMARY KEY (`Код автобуса`);

--
-- Индексы таблицы `тех.талоны`
--
ALTER TABLE `тех.талоны`
  ADD PRIMARY KEY (`Номер тех.талона`),
  ADD KEY `Код автобуса` (`Код автобуса`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `парк`
--
ALTER TABLE `парк`
  ADD CONSTRAINT `парк_ibfk_1` FOREIGN KEY (`Код автобуса`) REFERENCES `типы автобусов` (`Код автобуса`);

--
-- Ограничения внешнего ключа таблицы `путевой лист`
--
ALTER TABLE `путевой лист`
  ADD CONSTRAINT `путевой лист_ibfk_1` FOREIGN KEY (`Код автобуса`) REFERENCES `типы автобусов` (`Код автобуса`),
  ADD CONSTRAINT `путевой лист_ibfk_2` FOREIGN KEY (`Табельный номер водителя`) REFERENCES `водители` (`Табельный номер водителя`),
  ADD CONSTRAINT `путевой лист_ibfk_3` FOREIGN KEY (`Номер маршрута`) REFERENCES `маршрутный лист` (`Номер маршрута`);

--
-- Ограничения внешнего ключа таблицы `водители`
--
ALTER TABLE `водители`
  ADD CONSTRAINT `водители_ibfk_1` FOREIGN KEY (`Номер маршрута`) REFERENCES `маршрутный лист` (`Номер маршрута`);

--
-- Ограничения внешнего ключа таблицы `статистика`
--
ALTER TABLE `статистика`
  ADD CONSTRAINT `статистика_ibfk_1` FOREIGN KEY (`Код автобуса`) REFERENCES `типы автобусов` (`Код автобуса`),
  ADD CONSTRAINT `статистика_ibfk_2` FOREIGN KEY (`Табельный номер водителя`) REFERENCES `водители` (`Табельный номер водителя`);

--
-- Ограничения внешнего ключа таблицы `тех.талоны`
--
ALTER TABLE `тех.талоны`
  ADD CONSTRAINT `тех.талоны_ibfk_1` FOREIGN KEY (`Код автобуса`) REFERENCES `типы автобусов` (`Код автобуса`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
