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

    function timeToNextDay() {
        $now = strtotime('now');
        $tomorrow = strtotime('tomorrow midnight');
        $diff = $tomorrow - $now;

        $hours = floor($diff / 3600);
        $minutes = floor(($diff / 60) % 60);

        if ($hours < 10) {
            $hours = '0' . $hours;
        }

        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }

        return $hours . ':' . $minutes;
    }

    function isValidDate($date, $format= 'Y-m-d'){
        return $date == date($format, strtotime($date));
    }