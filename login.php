<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

$categories = db_fetch_data($link, 'SELECT name, id FROM categories');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];

    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = "Это поле нужно заполнить";
        }
    }

    $email = mysqli_real_escape_string($link, $form['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($link, $sql);

    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    if (!count($errors) && $user) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;

        } else {
            $errors['password'] = 'Неверный пароль';
        }
    } else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $page_content = include_template('enter.php', ['form' => $form, 'errors' => $errors]);
    } else {
        header("Location: /index.php");
        exit();
    }
} else {
    if (isset($_SESSION['user'])) {
        $page_content = include_template('index.php', []);
    }
    else {
        $page_content = include_template('enter.php', []);
    }
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'YetiCave | Страница входа'
]);

echo $layout_content;