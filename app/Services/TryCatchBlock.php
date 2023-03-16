<?php

namespace App\Services;

use App\Traits\Formatter;
use Closure;
use Illuminate\Support\Facades\DB;

class TryCatchBlock {

    use Formatter;

    public static function withDBBlock( Closure $callback ) {
        try {
            DB::beginTransaction();
            call_user_func($callback);
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            return (new TryCatchBlock)->withErrors($ex->getMessage());
        }
        return (new TryCatchBlock)->withSuccess('Successfully created.');
    }

    public static function onlyTryBlock( Closure $callback ) {
        try {

            call_user_func($callback);

        } catch (\Exception $ex) {
            return (new TryCatchBlock)->withErrors($ex->getMessage());
        }
    }
}
