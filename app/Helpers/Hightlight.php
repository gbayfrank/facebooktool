<?php
namespace App\Helpers;
use Config;

class Hightlight {
    public static function show($input, $paramsSearch, $field, $length = null) {
        $input = ((strlen($input) < $length) || ($length === null) || ($length < 0)) ? $input : substr($input, 0, $length) . '...';

        if($paramsSearch['value'] === '') return $input;
        
        if($paramsSearch['field'] === 'all' || $paramsSearch['field'] === $field) {
            return preg_replace('/' . preg_quote($paramsSearch['value'], '/') . "/i", "<span class='highlight'>$0</span>", $input);
        }

        return $input;
    }
}