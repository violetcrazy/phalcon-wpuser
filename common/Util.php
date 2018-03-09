<?php

namespace Common;

class Util {
    public function currencyFormat($number = 0){
        if (is_numeric($number)) {
            return number_format($number, 0, '.', ',');
        } else {
            return 0;
        }
    }

    public function formatDat($timeTemp)
    {
        if (is_numeric($timeTemp)){
            return date('H:i d/m/Y', $timeTemp);
        } else {
            return '';
        }
    }

    public static function addQueryArg($data)
    {
        $get = $_GET;
        $get = array_merge($get, $data);

        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $get['_url'];

        unset($get['_url']);
        $url .= "?" . http_build_query($get);

        return $url;
    }
}
