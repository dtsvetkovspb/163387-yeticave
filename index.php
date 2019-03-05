<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

$categories = db_fetch_data($link, 'SELECT name FROM categories');
$lots = db_fetch_data($link, 'SELECT lots.id, lots.name, c.name AS cat_name, start_price, picture FROM lots JOIN categories c ON c.id = cat_id');

$isAuth = rand(0, 1);

$userName = 'Dmitriy'; // укажите здесь ваше имя

$page_content = include_template('main.php', [
    'categories' => $categories,
    'lots' => $lots
]);

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'YetiCave | Главная',
    'isAuth' => $isAuth,
    'userName' => $userName
]);

echo $layout_content;





