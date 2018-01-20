<?php
namespace App\Api\V1\Admin\Transformers;

use App\Models\MarketPair;
use League\Fractal\TransformerAbstract;

class MarketPairTransformer extends TransformerAbstract
{

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = ['market','coin','currency'];

    /**
     * @param MarketPair $marketPair
     * @return array
     */
    public function transform(MarketPair $marketPair)
    {
        $data = [
            'id' => $marketPair->id,
            'market_id' => $marketPair->market_id,
            'currency_id' => $marketPair->currency_id,
            'coin_id' => $marketPair->coin_id,
            'market_name' => $marketPair->market->name,
            'currency_code' => $marketPair->currency->code,
            'coin_code' => $marketPair->coin->code,
        ];

        return $data;
    }

    /**
     * Include Market
     *
     * @param MarketPair $marketPair
     * @return mixed
     */
    public function includeMarket(MarketPair $marketPair)
    {
        $market = $marketPair->market()->get();

        return $this->collection($market, new MarketTransformer);
    }

    /**
     * Include Currency
     *
     * @param MarketPair $marketPair
     * @return mixed
     */
    public function includeCurrency(MarketPair $marketPair)
    {
        $currency = $marketPair->currency()->get();

        return $this->collection($currency, new CurrencyTransformer);
    }

    /**
     * Include Coin
     *
     * @param MarketPair $marketPair
     * @return mixed
     */
    public function includeCoin(MarketPair $marketPair)
    {
        $coin = $marketPair->coin;

        return $this->item($coin, new CoinTransformer);
    }
}

