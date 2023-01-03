<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';

    public function language()
    {
        # code...
        return $this->belongsTo('App\Language');
    }
}
