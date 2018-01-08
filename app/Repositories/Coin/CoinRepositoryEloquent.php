<?php

namespace App\Repositories\Coin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Coin\CoinRepositoryInterface;
use App\Models\Coin;

/**
 * Class CoinRepositoryEloquent
 * @package namespace App\Repositories\Coin;
 */
class CoinRepositoryEloquent extends BaseRepository implements CoinRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coin::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
