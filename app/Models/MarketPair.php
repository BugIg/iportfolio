<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MarketPair
 *
 * @property int $id
 * @property int $market_id
 * @property int $currency_id
 * @property int $coin_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereCoinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MarketPair whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MarketPair extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_id', 'currency_id', 'coin_id'
    ];

    /**
     * Get the market that owns the market pair.
     */
    public function market()
    {
        return $this->belongsTo('App\Models\Market');
    }

    /**
     * Get the currency that owns the market pair.
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    /**
     * Get the coin that owns the market pair.
     */
    public function coin()
    {
        return $this->belongsTo('App\Models\Coin');
    }
}
