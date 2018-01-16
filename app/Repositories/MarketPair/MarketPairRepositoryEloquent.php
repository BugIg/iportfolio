<?php

namespace App\Repositories\MarketPair;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MarketPair\MarketPairRepositoryInterface;
use App\Models\MarketPair;

/**
 * Class MarketPairRepositoryEloquent
 * @package namespace App\Repositories\Market;
 */
class MarketPairRepositoryEloquent extends BaseRepository implements MarketPairRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MarketPair::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
