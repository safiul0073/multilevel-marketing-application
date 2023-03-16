<?php

namespace App\Services;

use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiIndexQueryService {

    use Formatter;

    public static function indexQuery (mixed $query, array $eger_load, array $query_string= []) {

        $perPage = request()->perPage ?? 10;

        if (count($eger_load)) {
            $query->with($eger_load);
        }

        if (request()->form_date && request()->to_date) {
            $startDate = Carbon::createFromFormat('Y-m-d', request()->from_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', request()->to_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!count($query_string)){

            foreach($query_string as $string) {
                if (request()->query($string)) {
                    $query->whereLike(request()->query($string));
                }
            }
        }

        return (new ApiIndexQueryService())->withSuccess($query->paginate($perPage));
    }
}
