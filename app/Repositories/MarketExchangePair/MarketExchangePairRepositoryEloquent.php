<?php

namespace App\Repositories\MarketExchangePair;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MarketExchangePair\MarketExchangePairRepositoryInterface;
use App\Models\MarketExchangePair;

/**
 * Class MarketRepositoryEloquent
 * @package namespace App\Repositories\Market;
 */
class MarketExchangePairRepositoryEloquent extends BaseRepository implements MarketExchangePairRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MarketExchangePair::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
