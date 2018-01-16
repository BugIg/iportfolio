<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coin
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $status
 * @property int $rank
 * @property string|null $logo_ext
 * @property string|null $description
 * @property mixed|null $details
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Market[] $markets
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereLogoExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coin whereStatus($value)
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

}
