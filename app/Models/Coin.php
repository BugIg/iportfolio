<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coin
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property string $type
 * @property string $description
 * @property mixed $details
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'code', 'status', 'rank', 'description', 'details'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * The markets that belong to the coin.
     */
    public function markets()
    {
        return $this->belongsToMany('App\Models\Market')->withPivot('price');
    }
}
