<?php
require_once 'functions.php';

session_start();
$link = mysqli_connect('localhost', 'root', '', 'yeticave');
mysqli_set_charset($link, 'utf8');

$categories = [];
$content = '';