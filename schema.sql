CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(128)
);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name CHAR(64),
    description CHAR(128),
    picture CHAR(128),
    start_price INT,
    exp_date DATETIME,
    bet_step INT,
    user_id INT,
    winner_id CHAR(64),
    cat_id INT
);

CREATE TABLE bets (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    date_add    DATETIME,
    offer_price INT,
    user_id     INT,
    lot_id      INT
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_date DATETIME,
    email CHAR(64) UNIQUE,
    name CHAR(64),
    password CHAR(128),
    avatar CHAR(128),
    contacts CHAR(128),
    created_lots CHAR(128),
    bets_id INT
)