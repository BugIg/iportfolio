<?php

namespace App\Repositories\Market;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Market\MarketRepositoryInterface;
use App\Models\Market;

/**
 * Class MarketRepositoryEloquent
 * @package namespace App\Repositories\Market;
 */
class MarketRepositoryEloquent extends BaseRepository implements MarketRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Market::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
