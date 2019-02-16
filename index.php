<?php
require_once('functions.php');

$is_auth = rand(0, 1);
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$lots = [
    [
        'Name' => '2014 Rossignol District Snowboard',
        'Category' => 'Доски и лыжи',
        'Price' => '10999',
        'URL' => 'img/lot-1.jpg'
    ],
    [
        'Name' => 'DC Ply Mens 2016/2017 Snowboard',
        'Category' => 'Доски и лыжи',
        'Price' => '159999',
        'URL' => 'img/lot-2.jpg'
    ],
    [
        'Name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'Category' => 'Крепления',
        'Price' => '8000',
        'URL' => 'img/lot-3.jpg'
    ],
    [
        'Name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'Category' => 'Ботинки',
        'Price' => '10999',
        'URL' => 'img/lot-4.jpg'
    ],
    [
        'Name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'Category' => 'Одежда',
        'Price' => '7500',
        'URL' => 'img/lot-5.jpg'
    ],
    [
        'Name' => 'Маска Oakley Canopy',
        'Category' => 'Разное',
        'Price' => '5400',
        'URL' => 'img/lot-6.jpg'
    ]
];

$user_name = 'Dmitriy'; // укажите здесь ваше имя

function formattedNum($num) {
    $intNum = ceil($num);
    if ($intNum < 1000) {
        return $intNum . ' ₽';
    } else {
        $intNum = number_format($intNum, 0, ',', ' ');
        return $intNum . ' ₽';
    }
}

$page_content = include_template('main.php', [
    'categories' => $categories,
    'lots' => $lots
]);

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
