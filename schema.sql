
-- выбор и создание БД, устанка кодировки
CREATE DATABASE taskforce_db
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce_db;


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
	file_dest VARCHAR(128) NOT NULL,
	id_user INT,
	id_task INT
);


-- Отклики:
-- дата — дата и время размещения коммента;
-- сам отклик;

-- Связи:
-- пользователь;
-- задание;
CREATE TABLE comments(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	comment TEXT NOT NULL,
	id_user INT,
	id_task INT
);

-- Переписка:
-- дата — дата и время размещения коммента;
-- сообщение;

-- Связи:
-- текущий пользователь;
-- пользователь - собеседник;
CREATE TABLE messages(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	message TEXT NOT NULL,
	id_current_user INT,
	id_user INT
);

-- Избранное:

-- Связи:
-- текщий пользователь;
-- Полтзователь в избранном;

CREATE TABLE favourites(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	id_current_user INT,
	id_user INT
);




-- Представляет зарегистрированного пользователя.:

-- дата регистрации — дата и время, когда этот пользователь завёл аккаунт;
-- email;
-- имя;
-- пароль — хэшированный пароль пользователя;
-- аватарка;
-- полный адрес;
-- информация о себе;
-- skype (сделал уникальным);
-- messenger (сделал уникальным);
--что заказчик(bool)


-- Связи:
-- город
-- категории
-- задания
-- переписки
-- файлы
-- избранное
CREATE TABLE users(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	email VARCHAR(128) UNIQUE NOT NULL,
	name VARCHAR(64) NOT NULL,
	password VARCHAR(255) NOT NULL,
	img_url VARCHAR(128) DEFAULT 'img/user.jpg',
	adress VARCHAR(128),
	info VARCHAR(255),
	skype VARCHAR(128) UNIQUE,
	messenger VARCHAR(128) UNIQUE,
	id_city INT,
	is_author BOOLEAN DEFAULT FALSE,

	-- 	??
	categories_list,
	tasks_list,
	files_list,
	favorites_list,
);



-- Задание - Центральная сущность всего сайта:

-- дата создания — дата и время, когда создано
-- дата завершения;
-- кратное название — задается пользователем;
-- подробное описание — задается пользователем;
-- цена;
-- локация (город , координаты??? )



-- Связи:
-- автор — пользователь, создавший задание;
-- исполнитель — пользователь, выбпавший задание;
-- категория — категория объявления;
-- файлы задания
CREATE TABLE tasks(
	id INT PRIMARY KEY UNSIGNED AUTO_INCREMENT,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	dt_end TIMESTAMP,
	label VARCHAR(128) NOT NULL,
	description TEXT,
	price INT,
	location VARCHAR(128),

	id_author INT ,
	id_user INT,
	id_category INT
);









-- !!! Другие варианты установки связей и индексов:

-- Указываем (создаем уникальный индекс) что email - это уникальное значение
CREATE UNIQUE INDEX users_email_uindex ON users (email);
CREATE UNIQUE INDEX categories_name_uindex ON categories (name);
CREATE UNIQUE INDEX cities_name_uindex ON cities (name);

-- простые индексы (для ускорения выбрки и работы БД)
CREATE INDEX l_category_id_index ON tasks(id_category);
CREATE INDEX l_user_commnt_id_index ON comments(id_user);

-- ...




-- FOREING KEYS (показывает привязки столбцов таблиц как правило к Primary Key  - lots.user_id = user.id)


ALTER TABLE tasks
  ADD CONSTRAINT tasks_category_id__fk
FOREIGN KEY (id_category) REFERENCES categories (id);


-- ...
