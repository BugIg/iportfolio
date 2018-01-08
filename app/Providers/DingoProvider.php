<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Dingo\Api\Transformer\Adapter\Fractal;
use League\Fractal\Manager;
/**
 * Description of DingoProvider
 *
 * @author marcin
 */
class DingoProvider extends ServiceProvider {
    public function boot() {
//        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
//            return new \Dingo\Api\Transformer\Adapter\Fractal(new \League\Fractal\Manager, 'include', ',');
//        });
        $this->addSerializer();
    }
    private function addSerializer() {
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function($app) {
            $fractal = new Manager;
            $fractal->setSerializer(new \League\Fractal\Serializer\JsonApiSerializer());
            return new Fractal($fractal,'include',',');
        });
    }
    //put your code here
}