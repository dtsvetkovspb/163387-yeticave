<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'mysql_helper.php';

if (isset($_GET['id'])) {
    $categories = db_fetch_data($link, "SELECT name FROM categories");
    $user = $_SESSION['user'] ?? [];

    $lotId = mysqli_real_escape_string($link, $_GET['id']);
    $sql = "SELECT lots.name, c.name AS cat_name, start_price, picture, UNIX_TIMESTAMP(exp_date) FROM lots JOIN categories c ON c.id = cat_id WHERE lots.id = '%s'";

    $sql = sprintf($sql, $lotId);

    $lot = db_fetch_data($link, $sql);

    $sql2 = "SELECT offer_price, UNIX_TIMESTAMP(date_add), u.name FROM bets JOIN users u ON u.id = user_id WHERE bets.lot_id = '%s'";

    $sql2 = sprintf($sql2, $lotId);
    $bets = db_fetch_data($link, $sql2);
    $betsCount = count($bets);

    $betStep = db_fetch_data($link, "SELECT bet_step FROM lots WHERE id = '$lotId'");
    $betStep = isset($betStep[0]['bet_step']) ? $betStep[0]['bet_step'] : null;
    $startPrice = db_fetch_data($link, "SELECT start_price FROM lots WHERE id = '$lotId'");;
    $startPrice = isset($startPrice[0]['start_price']) ? $startPrice[0]['start_price'] : null;
    $currentPrice = db_fetch_data($link, "SELECT offer_price FROM bets WHERE lot_id = '$lotId'");

    $currentPrice ? $resPrice = max(array_column($currentPrice, 'offer_price')) : $resPrice = $startPrice;

    $required = ['cost'];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $form = $_POST;
        $lotId = mysqli_real_escape_string($link, $form['lotId']);

        $resPrice = 0;

        foreach ($required as $key) {

            if (empty($form[$key])) {
                $errors[$key] = ' Это поле надо заполнить';
            }

        }

        foreach ($form as $key => $value) {
            if ($key == 'cost' && $value) {
                if (!filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range"=> 0)))) {
                    $errors['cost'] = 'Содержимое поля должно быть целым числом больше ноля';
                }
                if ($value < $resPrice + $betStep) {
                    $errors['cost'] = 'Значение должно быть больше, чем текущая цена лота + шаг ставки';
                }
            }
        }

        if (count($errors) === 0) {
            $sql = 'INSERT INTO bets (date_add, offer_price, user_id, lot_ID) VALUES (NOW(), ?, ?, ?)';

            $stmt = db_get_prepare_stmt($link, $sql, [$form['cost'], $user['id'], $lotId]);
            mysqli_stmt_execute($stmt);
            header("Location: lot.php?id=" . $lotId);
        }
    }

    $page_content = include_template('lot-main.php', [
        'lot' => $lot,
        'bets' => $bets,
        'betsCount' => $betsCount,
        'resPrice' => $resPrice,
        'betStep' => $betStep,
        'lotId' => $lotId,
        'errors' => $errors
    ]);

}

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'Лот'
]);

if (!$lotId) {
    http_response_code(404);
    header('Location: 404.php');
    exit();
}
echo $layout_content;

