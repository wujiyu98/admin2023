<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $casts = [
        'prices' => 'json',
        'images' => 'json',
    ];
    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute');
    }
}
