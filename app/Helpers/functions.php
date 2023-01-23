<?php

use App\Models\Option;

if (!function_exists('get_option')) {
    function get_option($name, $default = null)
    {
        return Option::getOption($name, $default);
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('geMatchingSchedulerDateTime')) {
    function geMatchingSchedulerDateTime () {
        $matching_date = new \Carbon\Carbon(config('mlm.bonus.matching.end_time'));
        return $matching_date->add(config('mlm.bonus.matching.in_day') - 1, 'day');
    }
}
