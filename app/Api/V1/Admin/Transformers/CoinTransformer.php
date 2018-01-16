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
    protected $availableIncludes = [];

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
            'code' => $coin->code,
            'rank' => $coin->rank,
            'logo_ext' => $coin->logo_ext,
            'description' =>  $coin->description,
            'details' => json_decode($coin->details)
        ];

        return $data;
    }
}

