<?php

use App\Models\Option;
use App\Models\Transaction;

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

if (!function_exists('getTransactionTypeKeyword')) {
    function getTransactionTypeKeyword ($type) {
        $keyword = [];
        switch ($type) {
            case Transaction::DEATH:
                $keyword = [
                    "style" => 'bg-gray-500 text-white',
                    "keyword" => 'Death Fund'
                ];
                break;
            case Transaction::GIFT:
                $keyword = [
                    "style" => 'bg-green-500 text-white',
                    "keyword" => 'Gift'
                ];
                break;
            case Transaction::EDUCATION:
                $keyword = [
                    "style" => 'bg-indigo-500 text-white',
                    "keyword" => 'Education Fund'
                ];
                break;
            case Transaction::SALARY:
                $keyword = [
                    "style" => 'bg-green-600 text-white',
                    "keyword" => 'Salary'
                ];
                break;
            case Transaction::TRANSFER:
                $keyword = [
                    "style" => 'bg-red-500 text-white',
                    "keyword" => 'Transfer'
                ];
                break;
            default:
                $keyword = [
                    "style" => 'bg-yellow-500 text-white',
                    "keyword" => 'Subtract'
                ];
                break;
        }

        return $keyword;
    }
}
