<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

unset($_SESSION['user']);
header("Location: /index.php");