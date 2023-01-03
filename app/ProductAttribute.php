<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $guarded = [];
}
