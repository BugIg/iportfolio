<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Market
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property mixed $details
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Market extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'details',
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
     * The coins that belong to the market.
     */
    public function coins()
    {
        return $this->belongsToMany('App\Models\Coin')->withPivot('price');
    }
}
