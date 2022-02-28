DROP TABLE users;
CREATE TABLE IF NOT EXISTS users
(
    `row`           INT(11) AUTO_INCREMENT,
    `id`            TEXT,
    `name`          TEXT,
    `phone` TEXT,
    `password` TEXT,
    `admin` TEXT,
    `type`          TEXT,
    `status` TEXT,
    PRIMARY KEY (`row`)
);