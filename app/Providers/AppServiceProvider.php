<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        if ($this->app->environment() !== 'production') {
////            DB::listen(function ($query) {
////                var_dump([
////                    $query->sql,
////                    $query->bindings,
////                    $query->time
////                ]);
////            });
//        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        //app('Dingo\Api\Transformer\Factory')->register('User', 'UserTransformer');
    }
}
