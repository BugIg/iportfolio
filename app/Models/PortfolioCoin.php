<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


/**
 * App\Models\PortfolioCoin
 *
 * @property string $portfolio_id
 * @property int $coin_id
 * @property int $currency_id
 * @property int $market_id
 * @property string $type_trade
 * @property float $amount
 * @property float $price
 * @property string $time_trade
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereCoinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin wherePortfolioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereTimeTrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereTypeTrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PortfolioCoin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PortfolioCoin extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
