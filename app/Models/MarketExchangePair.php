<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketExchangePair extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_pair_id', 'exchange_rate', 'from_date', 'to_date', 'change', 'volume_24hours', 'order_book'
    ];

    /**
     * Get the market that owns the market pair.
     */
    public function market()
    {
        return $this->belongsTo('App\Models\MarketPair', 'market_pair_id');
    }
}
