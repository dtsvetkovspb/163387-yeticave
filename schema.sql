CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL
);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(64) NOT NULL,
    description VARCHAR(128),
    picture VARCHAR(128),
    start_price INT NOT NULL,
    exp_date DATETIME NOT NULL,
    bet_step INT NOT NULL,
    user_id INT,
    winner_id INT,
    cat_id INT NOT NULL
);

CREATE TABLE bets (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    date_add    DATETIME NOT NULL,
    offer_price INT NOT NULL,
    user_id     INT NOT NULL,
    lot_id      INT NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_date DATETIME NOT NULL,
    email VARCHAR(64) UNIQUE NOT NULL,
    name VARCHAR(64) NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(128),
    contacts VARCHAR(128) NOT NULL,
    created_lots VARCHAR(128),
    bets_id INT
)