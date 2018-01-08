<?php

namespace App\Repositories\Currency;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Currency\CurrencyRepositoryInterface;
use App\Models\Currency;

/**
 * Class CurrencyRepositoryEloquent
 * @package namespace App\Repositories\Currency;
 */
class CurrencyRepositoryEloquent extends BaseRepository implements CurrencyRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Currency::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
