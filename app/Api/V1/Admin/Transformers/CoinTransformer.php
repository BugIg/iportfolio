<?php
namespace App\Api\V1\Admin\Transformers;

use App\Models\Coin;
use League\Fractal\TransformerAbstract;

class CoinTransformer extends TransformerAbstract
{

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = ['markets'];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * @param Coin $coin
     * @return array
     */
    public function transform(Coin $coin)
    {
        $data = [
            'id' => $coin->id,
            'name' => $coin->name,
            'symbol' => $coin->symbol,
            'type' => $coin->type,
            'description' =>  $coin->description,
            'details' => json_decode($coin->details)
        ];

        if(isset($coin->pivot)) {
            $data['price'] = $coin->pivot['price'];
        }

        return $data;
    }

    /**
     * Include Market
     *
     * @param Coin $coin
     * @return mixed
     */
    public function includeMarkets(Coin $coin)
    {
        $markets = $coin->markets()->withPivot('price')->get();

        return $this->collection($markets, new MarketTransformer);
    }
}

