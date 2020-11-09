<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bu extends Model
{
    protected $fillable = [
        'bu_name',
        'bu_price',
        'bu_rooms',
        'bu_rent',
        'bu_square',
        'bu_type',
        'bu_small_dis',
        'bu_meta',
        'bu_longitude',
        'bu_Latitude',
        'bu_large_dis',
        'bu_status',
        'user_id',
        'bu_place',
        'image',
        'month'
        ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $attributes = [
        'bu_status' => 0
    ];

}
