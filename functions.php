<?php

    function include_template($name, $data) {
        $name = 'templates/' . $name;
        $result = '';

        if (!is_readable($name)) {
            return $result;
        }

        ob_start();
        extract($data);
        require $name;

        $result = ob_get_clean();

        return $result;
    }

    function formattedNum($num) {
        $intNum = ceil($num);
        if ($intNum < 1000) {
            return $intNum . ' ₽';
        } else {
            $intNum = number_format($intNum, 0, ',', ' ');
            return $intNum . ' ₽';
        }
    }

    function timeDiff($unixtime) {
        $now = strtotime('now');
        $diff = $now - $unixtime;
        $timeOfBet = date('d.m.y \в H:i', $unixtime);
        $hoursDiff = floor($diff / 3600);
        $minutesDiff = floor(($diff / 60) % 60);

        if ($hoursDiff < 1) {
            return $minutesDiff . ' минут назад';
        } else if ($hoursDiff >= 1 && $hoursDiff < 2) {
            return 'Час назад';
        } else {
            return $timeOfBet ;
        }
    }

    function getHoursMinsDiff($unixtime) {
        $now = strtotime('now');
        $diff = $unixtime - $now ;
        $hoursDiff = floor($diff / 3600);
        $minutesDiff = floor(($diff / 60) % 60);

        return $hoursDiff . ':' . $minutesDiff;
    }

    function isValidDate($date, $format = 'Y-m-d'){
        return $date == date($format, strtotime($date));
    }