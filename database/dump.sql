--
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Удалить таблицу `goods`
--
DROP TABLE IF EXISTS goods;

--
-- Создать таблицу `goods`
--
CREATE TABLE goods (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  title varchar(255) DEFAULT NULL,
  price decimal(19, 2) NOT NULL DEFAULT 0.00,
  status tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;