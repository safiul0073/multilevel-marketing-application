<?php

namespace App\Services;

use App\Traits\Formatter;

class ApiIndexQueryService {

    use Formatter;

    public static function indexQuery (mixed $query, array $eger_load = [], array $attributes= []) {

        $per_page = request()->perPage ?? 10;
        $order_of = request()->orderOf ?? "id";
        $order_by = request()->orderBy ?? "DESC";

        if (count($eger_load)) {
            $query->with($eger_load);
        }

        $query->whereDateBetween('created_at', request()->from_date,  request()->to_date);

        if (request()->query('search')) {
            $query->whereLike($attributes, request()->query('search'));
        }

        return (new ApiIndexQueryService())
                ->withSuccess($query->orderBy($order_of, $order_by)
                ->paginate($per_page));
    }
}
