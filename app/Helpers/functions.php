<?php

use App\Models\Option;
use App\Models\Transaction;
use Carbon\Carbon;

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
            case Transaction::RECEIVED:
                $keyword = [
                    "style" => 'bg-blue-500 text-white',
                    "keyword" => 'Transfer Received'
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

    if (!function_exists('getDateArray')) {
        function getDateArray ($days = 6) {
            $date = Carbon::now();
            $dateTime = Carbon::parse($date->add(-$days, 'day'));
            $start_date = Carbon::createFromFormat('Y-m-d', $dateTime->format('Y-m-d'))->startOfDay();
            $end_date = Carbon::createFromFormat('Y-m-d', '2023-03-01')->endOfDay();

            return [
                $start_date,
                $end_date
            ];
        }
    }

    if (!function_exists('cal_days_in_year')) {
        function cal_days_in_year($year){
            $days=0;
            for($month=1;$month<=12;$month++){
                $days = $days + cal_days_in_month(CAL_GREGORIAN,$month,$year);
             }
         return $days;
        }
    }
}
