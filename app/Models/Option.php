<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    private static $autoload;

    public static function getOption($name, $default = null) {
        if (!self::$autoload) {
            self::$autoload = self::pluck('content', 'name')->toArray();
        }

        if (!isset(self::$autoload[$name])) return $default;

        return self::$autoload[$name];
    }

    public static function updateOption($name, $value) {


        return (bool) self::updateOrCreate(['name' => $name], ['content' => $value]);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($option) {

            if ($option->name == 'mlm_matching_bonus') {
                $decoded = json_decode($option->content, true);
                $matching_date = new \Carbon\Carbon($decoded['end_time']);
                $final_date = $matching_date->add($decoded['in_day'] - 1, 'day');
                TaskScheduler::updateOrCreate(['title' => 'matching'], ['date_time' => $final_date]);
            }
        });

    }
}
