<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

$categories = db_fetch_data($link, 'SELECT name FROM categories');
$lots = db_fetch_data($link, 'SELECT lots.id, UNIX_TIMESTAMP(exp_date), lots.name, c.name AS cat_name, start_price, picture FROM lots JOIN categories c ON c.id = cat_id');

$page_content = include_template('main.php', [
    'categories' => $categories,
    'lots' => $lots
]);

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'YetiCave | Главная'
]);

echo $layout_content;





