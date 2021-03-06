INSERT INTO lots (name, description, exp_date, bet_step, cat_id, start_price, picture)
VALUES ('2014 Rossignol District Snowboard', 'test', '2019-03-20 10:30:00', 1000, 1, 10999, 'img/lot-1.jpg'),
       ('DC Ply Mens 2016/2017 Snowboard', 'test', '2019-03-19 12:50:00', 1000, 1, 159999, 'img/lot-2.jpg'),
       ('Крепления Union Contact Pro 2015 года размер L/XL', 'test', '2019-03-21 1:10:00', 1000, 2, 8000, 'img/lot-3.jpg'),
       ('Ботинки для сноуборда DC Mutiny Charocal', 'test', '2019-03-21 15:10:00', 1000, 3, 10999, 'img/lot-4.jpg'),
       ('Куртка для сноуборда DC Mutiny Charocal', 'test', '2019-03-19 3:25:00', 1000, 4, 7500, 'img/lot-5.jpg'),
       ('Маска Oakley Canopy', 'test', '2019-03-19 18:21:00', 1000, 6, 5400, 'img/lot-6.jpg');

INSERT INTO categories (name)
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO users (registration_date, email, name, password, contacts)
VALUES ('2018-06-18 10:34:09', 'dstvetkov@gmail.com', 'Dmitriy', 'qwertyasd', 'SPB'),
       ('2019-01-13 10:34:09', 'test@gmail.com', 'Vladimir', 'qwertyasd', 'SPB');

INSERT INTO bets (date_add, offer_price, user_id, lot_id)
VALUES (NOW(), 12000, 1, 1),
       (NOW(), 13000, 2, 1);

SELECT name FROM categories;

SELECT name, start_price, picture, cat_id FROM lots;

SELECT l.id, c.name
FROM lots l
JOIN categories c ON l.id = c.id
WHERE l.id = 1;

UPDATE lots SET name = '2014 Rossignol District Snowboard'
WHERE lots.id = 1;

SELECT offer_price, lot_id FROM bets WHERE lot_id = 1;
