<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

$categories = db_fetch_data($link, 'SELECT name, id FROM categories');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST['signup'] ?? [];
    $dict = ['email' => 'Email', 'password' => 'Пароль', 'user-name' => 'Имя пользователя', 'message' => 'Контактные данные', 'file' => 'Аватар'];
    $errors = [];
    $required = ['email', 'password', 'name', 'message'];
    $isAvatar = false;

    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = "Это поле нужно заполнить";
        }
    }

    foreach ($form as $key => $value) {
        if ($key == 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Не правильный email';
            }
        }
    }

    if (isset($_FILES['avatar']) && $_FILES["avatar"]["error"] == 0) {
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $path = $_FILES['avatar']['name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        if ($file_type !== "image/png" && $file_type !== "image/jpg" && $file_type !== "image/jpeg") {
            $errors['file'] = 'Загрузите картинку в формате PNG/JPG/JPEG';
        } else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $form['path'] = 'img/'. $path;
            $isAvatar = true;
        }
    }

    if (count($errors)) {
        $page_content = include_template('reg.php', ['form' => $form, 'errors' => $errors, 'dict' => $dict]);
    } else {

        $email = mysqli_real_escape_string($link, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($link, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
            $page_content = include_template('reg.php', ['form' => $form, 'errors' => $errors, 'dict' => $dict]);
        }

        $password = password_hash($form['password'], PASSWORD_DEFAULT);

        if (!$isAvatar) {
            $sql = 'INSERT INTO users (registration_date, email, name, password, contacts) VALUES (NOW(), ?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$form['email'], $form['name'], $password, $form['message']]);
        } else {
            $sql = 'INSERT INTO users (registration_date, email, name, password, contacts, avatar) VALUES (NOW(), ?, ?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$form['email'], $form['name'], $password, $form['message'], $form['path']]);
        }

        $res = mysqli_stmt_execute($stmt);

        if ($res && empty($errors)) {
            header("Location: /index.php");
            exit();
        }
    }
} else {
    $page_content = include_template('reg.php', []);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'YetiCave | Регистрация'
]);

echo $layout_content;