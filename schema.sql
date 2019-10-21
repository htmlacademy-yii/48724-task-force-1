
-- выбор и создание БД, устанка кодировки
CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;



-- Представляет зарегистрированного пользователя.:

-- дата регистрации — дата и время, когда этот пользователь завёл аккаунт;
-- email;
-- имя;
-- др
-- пароль — хэшированный пароль пользователя;
-- аватарка;
-- полный адрес;
-- информация о себе;
-- телефон
-- skype (сделал уникальным);
-- messenger (сделал уникальным);
-- счетчик просмотров
-- показывать комменты только заказчику

-- Связи:
-- город
-- категории
-- задания
-- переписки
-- файлы
-- избранное
CREATE TABLE users(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	dt_birthday DATETIME,
	email VARCHAR(128) UNIQUE NOT NULL,
	name VARCHAR(64) NOT NULL,
	password VARCHAR(255) NOT NULL,
	avatar VARCHAR(255),
	address VARCHAR(500),
	phone VARCHAR(20),
	info TEXT,
	skype VARCHAR(128),
	messenger VARCHAR(128),
	city_id INT,
	view_count INT DEFAULT 0,
	show_for_customers TINYINT DEFAULT 0
);


-- Задание - Центральная сущность всего сайта:

-- дата создания — дата и время, когда создано
-- дата завершения;
-- срок исполнения
-- кратное название — задается пользователем;
-- подробное описание — задается пользователем;
-- категория
-- цена;
-- локация (город , координаты )

-- Связи:
-- автор —  юзер, создавший задание;
-- исполнитель — пользователь, выбпавший задание;
-- категория — категория объявления;
CREATE TABLE tasks(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	dt_end DATETIME,
	dt_deadline DATETIME,
	name VARCHAR(255) NOT NULL,
	description TEXT,
	category_id INT,
	price INT NULL,
	city_id INT,
	location_id INT,
  customer_id INT,
	executer_id INT
);

-- Локация (координаты):
-- lat
-- lon
CREATE TABLE locations(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	lat DECIMAL(10, 8),
	lon DECIMAL(11, 8)
);



-- КАТЕГОРИЯ:
-- id
-- имя
CREATE TABLE categories(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	name VARCHAR(32) UNIQUE
);


-- Города:
-- id
-- city
CREATE TABLE cities(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	city VARCHAR(32) UNIQUE
);


-- Файлы:
-- путь к файлу

-- Связи:
-- задание - к какому заданию относятся;
-- ползователь - или к какому пользователю;

CREATE TABLE files(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	path VARCHAR(128) NOT NULL
);

-- Файлы пользователя:
CREATE TABLE user_files(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	user_id INT
);

-- Файлы заданий:
CREATE TABLE task_files(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	task_id INT
);


-- Отклики:
-- дата — дата и время размещения коммента;
-- сам отклик;
-- оценка
-- пользователь;
-- задание;
CREATE TABLE user_reviews(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	comment TEXT NOT NULL,
	rating TINYINT,
	user_id INT,
	task_id INT
);


-- Переписка:
-- дата — дата и время размещения коммента;
-- сообщение;
-- отправитель
-- получатель
-- просмотрено ли сообшение

CREATE TABLE user_messages(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	message TEXT NOT NULL,
	sender_id INT,
	recipient_id INT,
	viewed TINYINT DEFAULT 0
);

-- Избранное:

-- Связи:
-- текщий пользователь;
-- Полтзователь в избранном;
CREATE TABLE user_favorites(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	owner_id INT,
	favorite_user_id INT
);

-- Связи категорий и пользователя:

-- Связи:
-- польщователь
-- категория
CREATE TABLE user_categories(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	user_id INT,
	category_id INT
);

--  Таблица уведомлений:
CREATE TABLE user_notifications(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	user_id INT,
	new_messge TINYINT DEFAULT 0,
	task_action TINYINT DEFAULT 0,
	new_review TINYINT DEFAULT 0
);




-- !!! Другие варианты установки связей и индексов:

-- Указываем (создаем уникальный индекс) что email - это уникальное значение
CREATE UNIQUE INDEX users_email_uindex ON users (email);
CREATE UNIQUE INDEX categories_name_uindex ON categories(name);
CREATE UNIQUE INDEX cities_name_uindex ON cities (name);

-- верно
CREATE UNIQUE INDEX user_categories_user_id_category_id_uindex ON user_categories (user_id, category_id);

-- простые индексы (для ускорения выбрки и работы БД)
CREATE INDEX l_category_id_index ON tasks(category_id);


-- добавить уникальные ключи



-- FOREING KEYS (показывает привязки столбцов таблиц как правило к Primary Key  - lots.user_id = user.id)
ALTER TABLE tasks
  ADD CONSTRAINT tasks_category_id__fk
FOREIGN KEY (id_category) REFERENCES categories (id);

ALTER TABLE user_categories
   ADD UNIQUE (category_id) (`имяПоля1`, `имяПоля2`, ...);

-- ...

ALTER TABLE `имяТаблицы`
   ADD UNIQUE `имяИндекса` (`имяПоля1`, `имяПоля2`, ...);
