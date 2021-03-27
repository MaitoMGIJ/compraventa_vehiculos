<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        Builder::macro('toCsv', function($columns = []){
            $results = $this->get(array_values($columns));
            if($results->count() < 1) return;

            $titles = implode(config('exports.separator'), array_map(function($title){
                return __('tags.'.$title);
            }, array_keys($columns)));
            //$titles = implode(',', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function($result){
                return implode(config('exports.separator'), collect($result->getAttributes())->map(function ($thing){
                    return '"'.$thing.'"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode(config('exports.end_line'));
        });
    }
}
