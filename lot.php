<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

if (isset($_GET['id'])) {
    $categories = db_fetch_data($link, "SELECT name FROM categories");

    $id = mysqli_real_escape_string($link, $_GET['id']);
    $sql = "SELECT lots.name, c.name AS cat_name, start_price, picture FROM lots JOIN categories c ON c.id = cat_id WHERE lots.id = '%s'";

    $sql = sprintf($sql, $id);

    $lot = db_fetch_data($link, $sql);
    if ($lot) {
        $page_content = include_template('lot-main.php', [
            'lot' => $lot
        ]);
    } else {
        http_response_code(404);
        $page_content = include_template('error-page.php', [

        ]);
    }

} else {
    http_response_code(404);
    $page_content = include_template('error-page.php', [

    ]);
}

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'Лот'
]);

echo $layout_content;

