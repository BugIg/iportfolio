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
    protected $availableIncludes = [];

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
            'logo_ext' => $market->logo_ext,
            'details' => json_decode($market->details)
        ];

        return $data;
    }
}

