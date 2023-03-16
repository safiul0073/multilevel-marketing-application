<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // WhereLike scope for Eloquent models
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (\Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereRelation($relationName, $relationAttribute, "Like", "%{$searchTerm}%");
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        // whereDateBetween for eloquent model
        Builder::macro('WhereDateBetween', function (string $attribute, string $from_date, string $to_date) {
            $this->when($from_date && $to_date, function (Builder $builder) use($attribute, $from_date, $to_date) {
                $startDate = Carbon::createFromFormat('Y-m-d', $from_date)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $to_date)->endOfDay();
                $builder->whereBetween($attribute, [$startDate, $endDate]);
            });
        });
    }
}
