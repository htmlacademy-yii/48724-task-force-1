
-- выбор и создание БД, устанка кодировки
CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE users(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
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


CREATE TABLE tasks(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
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


CREATE TABLE locations(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	lat DECIMAL(10, 8),
	lon DECIMAL(11, 8)
);


CREATE TABLE categories(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32) UNIQUE
);


CREATE TABLE cities(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32) UNIQUE
);


CREATE TABLE files(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	path VARCHAR(128) NOT NULL
);


CREATE TABLE user_files(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	file_id INT
);


CREATE TABLE task_files(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	task_id INT,
  file_id INT
);


CREATE TABLE user_reviews(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	comment TEXT NOT NULL,
	rating TINYINT,
	user_id INT,
	task_id INT
);


CREATE TABLE user_messages(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	dt_create DATETIME DEFAULT CURRENT_TIMESTAMP,
	message TEXT NOT NULL,
	sender_id INT,
	recipient_id INT,
	viewed TINYINT DEFAULT 0
);


CREATE TABLE user_favorites(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	owner_id INT,
	favorite_user_id INT
);


CREATE TABLE user_categories(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	category_id INT
);


CREATE TABLE user_notifications(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	new_messge TINYINT DEFAULT 0,
	task_action TINYINT DEFAULT 0,
	new_review TINYINT DEFAULT 0
);


-- Уникальные ключи:
CREATE UNIQUE INDEX users_email_uindex ON users(email);
CREATE UNIQUE INDEX cities_name_uindex ON cities(name);
CREATE UNIQUE INDEX categories_name_uindex ON categories(name);
-- одна категория у юзера
CREATE UNIQUE INDEX user_categories_user_id_category_id_uindex ON user_categories (user_id, category_id);


-- Простые индексы (для сортировки и ускорения выбрки и работы БД)
CREATE INDEX tasks_category_id_index ON tasks(category_id);
CREATE INDEX user_reviews_dt_create_id_index ON user_reviews(dt_create);
CREATE INDEX user_messages_dt_create_id_index ON user_messages(dt_create);
CREATE INDEX tasks_dt_create_id_index ON tasks(dt_create);


-- FOREING KEYS (показывает привязки столбцов таблиц как правило к Primary Key  - lots.user_id = user.id)
ALTER TABLE users
  ADD CONSTRAINT users_city_id__fk
FOREIGN KEY (city_id) REFERENCES cities (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_city_id__fk
FOREIGN KEY (city_id) REFERENCES cities (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_category_id__fk
FOREIGN KEY (category_id) REFERENCES categories (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_location_id__fk
FOREIGN KEY (location_id) REFERENCES locations (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_customer_id__fk
FOREIGN KEY (customer_id) REFERENCES users (id);

ALTER TABLE tasks
  ADD CONSTRAINT tasks_executer_id__fk
FOREIGN KEY (executer_id) REFERENCES users (id);

ALTER TABLE user_files
  ADD CONSTRAINT user_files_user_id__fk
FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE user_files
  ADD CONSTRAINT user_files_file_id__fk
FOREIGN KEY (file_id) REFERENCES files (id);

ALTER TABLE task_files
  ADD CONSTRAINT task_files_user_id__fk
FOREIGN KEY (file_id) REFERENCES tasks (id);

ALTER TABLE task_files
  ADD CONSTRAINT task_files_file_id__fk
FOREIGN KEY (task_id) REFERENCES files (id);

ALTER TABLE user_reviews
  ADD CONSTRAINT user_reviews_user_id__fk
FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE user_reviews
  ADD CONSTRAINT user_reviews_task_id__fk
FOREIGN KEY (task_id) REFERENCES tasks (id);

ALTER TABLE user_messages
  ADD CONSTRAINT user_messages_sender_id__fk
FOREIGN KEY (sender_id) REFERENCES users (id);

ALTER TABLE user_messages
  ADD CONSTRAINT user_messages_recipient_id__fk
FOREIGN KEY (recipient_id) REFERENCES users (id);

ALTER TABLE user_favorites
  ADD CONSTRAINT user_favorites_owner_id__fk
FOREIGN KEY (owner_id) REFERENCES users (id);

ALTER TABLE user_favorites
  ADD CONSTRAINT user_favorites_favorite_user_id__fk
FOREIGN KEY (favorite_user_id) REFERENCES users (id);

ALTER TABLE user_notifications
  ADD CONSTRAINT user_notifications_user_id__fk
FOREIGN KEY (user_id) REFERENCES users (id);



