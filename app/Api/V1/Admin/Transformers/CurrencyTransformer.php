<?php
namespace App\Api\V1\Admin\Transformers;

use App\Models\Currency;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract
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
    protected $defaultIncludes = [];

    /**
     * @param Currency $currency
     * @return array
     */
    public function transform(Currency $currency)
    {
        $data = [
            'id' => $currency->id,
            'name' => $currency->name,
            'code' => $currency->code,
            'symbol_left' => $currency->symbol_left,
            'symbol_right' => $currency->symbol_right,
            'rank' => $currency->rank,
        ];

        return $data;
    }
}

