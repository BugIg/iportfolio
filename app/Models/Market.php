<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Market
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $rank
 * @property string|null $description
 * @property string|null $logo_ext
 * @property mixed|null $details
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketPair[] $market_pairs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereLogoExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Market whereStatus($value)
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
        'name', 'description', 'details',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
