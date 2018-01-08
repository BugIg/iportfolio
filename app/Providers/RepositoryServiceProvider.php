<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Log;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('DB_LOGGING', false) === true) {
            DB::listen(function($query) {
                Log::info($query->time . ' : ' .$query->sql, $query->bindings);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            "User\UserRepositoryInterface" => 'User\UserRepositoryEloquent',
            "Coin\CoinRepositoryInterface" => 'Coin\CoinRepositoryEloquent',
            "Market\MarketRepositoryInterface" => 'Market\MarketRepositoryEloquent',
            "Currency\CurrencyRepositoryInterface" => 'Currency\CurrencyRepositoryEloquent',
        ];

        foreach ($repositories as $key => $value) {
            $this->app->bind("App\\Repositories\\$key","App\\Repositories\\$value");
        }

    }
}
