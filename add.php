<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

$showCategories = true;
$categories = db_fetch_data($link, 'SELECT name, id FROM categories');

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    $page_content = include_template('no-auth.php', []);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lot = $_POST;
    $user = $_SESSION['user'] ?? [];

    $required = ['lot-name', 'category', 'description', 'lot-rate', 'lot-step', 'lot-date'];
    $dict = ['lot-name' => 'Название', 'category' => 'Категория', 'description' => 'Описание', 'file' => 'Картинка', 'lot-rate' => 'Стартовая цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания аукциона'];
    $errors = [];

    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = ' Это поле надо заполнить';
        }
    }

    foreach ($_POST as $key => $value) {

        if ($key === 'lot-step' || $key === 'lot-rate') {
            if (!filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range"=> 0)))) {
                $errors[$key] = 'Содержимое поля должно быть целым числом больше ноля';
            }
        }

        if ($key === 'lot-date') {


            if (isValidDate($value, 'd-m-Y')) {
                $errors[$key] = 'Содержимое поля «дата завершения» должно быть датой в формате «ДД.ММ.ГГГГ»;';
            } else {
                $tomorrow = new DateTime('tomorrow');
                $user_date = new DateTime($value);

                if ($user_date < $tomorrow) {
                    $errors[$key] = 'Дата должна быть больше текущей даты, хотя бы на один день';
                }
            }
        }
    }


    if (isset($_FILES['lot-img']) && $_FILES["lot-img"]["error"] === 0) {
        $tmp_name = isset($_FILES['lot-img']['tmp_name']) ? $_FILES['lot-img']['tmp_name'] : null;
        $path = isset($_FILES['lot-img']['name']) ? $_FILES['lot-img']['name'] : null;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);


        if ($file_type !== "image/png" && $file_type !== "image/jpg" && $file_type !== "image/jpeg") {
            $errors['file'] = 'Загрузите картинку в формате PNG/JPG/JPEG';
        } else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $lot['path'] = 'img/'. $path;
        }

    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
        $page_content = include_template('add-main.php', ['categories' => $categories, 'lot' => $lot, 'errors' => $errors, 'dict' => $dict]);
    } else {

        $sql = 'INSERT INTO lots (dt_add, cat_id, name, description, user_id, start_price, bet_step, exp_date, picture) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?)';

        $userId = isset($user['id']) ? $user['id'] : null;
        $lotCategory = isset($lot['category']) ? $lot['category'] : null;
        $lotName = isset($lot['lot-name']) ? $lot['lot-name'] : null;
        $lotDescription = isset($lot['description']) ? $lot['description'] : null;
        $lotRate = isset($lot['lot-rate']) ? $lot['lot-rate'] : null;
        $lotStep = isset($lot['lot-step']) ? $lot['lot-step'] : null;
        $lotDate = isset($lot['lot-date']) ? $lot['lot-date'] : null;
        $lotPath = isset($lot['path']) ? $lot['path'] : null;

        $stmt = db_get_prepare_stmt($link, $sql, [$lotCategory, $lotName, $lotDescription, $userId, $lotRate, $lotStep, $lotDate, $lotPath]);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $lot_id = mysqli_insert_id($link);

            header("Location: lot.php?id=" . $lot_id);
        } else {
            $page_content = include_template('error-page.php', ['error' => mysqli_error($link)]);
        }
    }

} else {
    $page_content = include_template('add-main.php', ['categories' => $categories]);
}

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'YetiCave | Добавление лота',
    'showCategories' => $showCategories
]);

echo $layout_content;
