-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 20 2017 г., 16:24
-- Версия сервера: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- Версия PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text,
  `created` datetime DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `text`, `created`, `parent_id`) VALUES
(1, 3, 2, 'Очень жаль! Классная группа!!!!', '2017-09-18 21:08:53', 0),
(2, 3, 2, 'И не говорите)))', '2017-09-19 15:57:21', 0),
(3, 3, 2, 'Хорош спамить!', '2017-09-19 16:06:14', 0),
(7, 3, 2, 'Поддерживаю! Старенькие, но все равно популярные!', '2017-09-19 16:33:49', 1),
(9, 2, 2, 'Good article!!!!!!', '2017-09-19 17:50:32', 0),
(14, 3, 4, 'Hard Rock!', '2017-09-19 23:55:02', 1),
(28, 7, 4, 'Куда мир катится?!', '2017-09-20 15:41:53', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1505663134),
('m170917_154303_create_user_table', 1505663138),
('m170917_163350_create_post_table', 1505667263),
('m170917_164533_create_comment_table', 1505667265),
('m170918_150423_add_parent_id_to_comment', 1505747376),
('m170919_205334_drop_email_column_from_user_table', 1505854454);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `comments_status` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `description`, `image`, `created`, `comments_status`) VALUES
(2, 2, ' АМКУ оштрафовал lifecell и рассматривает дела других мобильных операторов', 'Антимонопольный комитет Украины (АМКУ) принял решение наложить штраф в размере 19 млн 466,84 тыс. грн на оператора мобильной связи lifecell по делу в отношении коммуникации условий тарификации звонков, сообщил глава АМКУ Юрий Терентьев.\r\n"Ответчик в коммуникации с потребителями указывал, что тарификация "посекундная". В то же время фактическая тарификация происходит в размере полной стоимости минуты за каждую первую секунду каждой начавшейся минуты", – пояснил он и уточнил, что речь идет о нарушении ст. 15-1 закона "О защите от недобросовестной конкуренции" (распространение информации, вводящей в заблуждение).\r\nВ ответ на публикацию в Facebook глава АМКУ получил множество комментариев, что "все так делают". На еще одну подобную запись "А у МТС и "Киевстара" разве не так же? Почему их тоже не оштрафовали? Или они занесли "кому надо"?", Терентьев ответил: "В работе".\r\nОператор lifecell при этом заявил, что не согласен с решением АМКУ взыскать с него штраф. "Штраф наложен на наименьшего из трех игроков на рынке, тогда как компании "ВФ Украина" (бренд "Vodafone Украина", ранее "МТС Украина") с почти вдвое большей абонбазой, применяющей аналогичный способ тарификации, комитет в декабре 2016 года предоставил лишь рекомендации, а в феврале 2017 года закрыл производство по делу без применения штрафных санкций", – подчеркнули в lifecell.', '/uploads/blog_1505910087.jpg', '2017-09-20 15:21:27', 1),
(3, 2, 'СМИ сообщили о распаде Rammstein', 'Будущий альбом группы якобы станет последним.\r\nНемецкий таблоид Bild сообщил о распаде известной рок-группы Rammstein. По информации издания, будущий альбом коллектива якобы станет последним.\r\nИзвестно, что альбом будет выпущен Rammstein после длительного перерыва. Последняя пластинка была презентована еще в 2009 году.\r\nТакже издание сообщает, что музыканты могут в 2019 году отправиться в прощальный тур.\r\nЧто касается дальнейшего будущего исполнителей, то они, по имеющейся информации OE24, планируют заняться сольными проектами.\r\nВ настоящее время официальная информация о распаде коллектива не была обнародована.\r\nРанее Корреспондент.net сообщал, что фронтмен группы Rammstein недавно стал гостем фестиваля "Жара" в Азербайджане.', '/uploads/blog_1505744814.jpg', '2017-09-17 20:49:05', 1),
(7, 4, 'Рабский труд более 40 млн человек используется в наши дни – Международная организация труда', 'Более 70% людей, привлеченных к принудительному труду, составляют женщины, рассказали в организации.\r\nБолее 40 млн человек находятся в наши дни в рабстве – такие данные содержатся в докладе, распространенном во вторник Международной организацией труда (МОТ).\r\nВ МОТ указывают, что значительную долю – 29 млн, или 71% от общего числа людей, привлеченных к принудительному труду, составляют женщины.\r\nКроме того, по оценочным данным организации, сейчас в мире используется труд примерно 152 млн детей в возрасте от пяти до 17 лет.\r\nДетский труд используется большей частью в сельском хозяйстве (70,9%), секторе услуг (17,1%) и промышленности (11,9%), свидетельствуют данные МОТ.', '/uploads/blog_1505911259.jpg', '2017-09-20 15:40:59', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `status`, `created_at`, `updated_at`) VALUES
(2, 'demo', 'LKqfhwwBnWrmO82PFTejLvf2iXT1ufE1', '$2y$13$6Wrl.tz.xgFEnJ2GcufkFeo.3AxyupvHeHccOzauPmzG2bsxx7OIS', 10, 1505664088, 1505664088),
(4, 'Freelancer', 'l-01AwWuN5wNX4_az02e3-rD0S0LhrT3', '$2y$13$BOcUyiH24reC5PAVD6JHoulW0N5hzKbLrqfLjf8uo6ELuYyzTktvO', 10, 1505854463, 1505854463);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-comment-post_id` (`post_id`),
  ADD KEY `idx-comment-user_id` (`user_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-post-user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk-comment-post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-comment-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk-post-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
