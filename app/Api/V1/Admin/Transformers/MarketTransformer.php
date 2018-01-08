<?php
namespace App\Api\V1\Admin\Transformers;

use App\Models\Market;
use League\Fractal\TransformerAbstract;

class MarketTransformer extends TransformerAbstract
{

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = ['coins'];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * @param Market $market
     * @return array
     */
    public function transform(Market $market)
    {
        $data = [
            'id' => $market->id,
            'name' => $market->name,
            'description' => $market->description,
            'details' => json_decode($market->details)
        ];

        if( isset($market->pivot)) {
            $data['price'] =  $market->pivot['price'];
        }

        return $data;
    }

    /**
     * Include Market
     *
     * @param Market $market
     * @return mixed
     */
    public function includeCoins(Market $market)
    {
        $coins = $market->coins()->withPivot('price')->get();;

        return $this->collection($coins, new CoinTransformer);
    }
}

