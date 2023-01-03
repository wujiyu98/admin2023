<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $casts = [
        'products' => 'array',
    ];
}
