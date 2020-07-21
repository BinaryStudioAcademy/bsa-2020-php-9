<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'user_id', 'price', 'start_date'
    ];

    protected $dates = [
        'start_date',
    ];

    public function user()
    {
        return $this->hasOne('App\Entities\User');
    }
}
