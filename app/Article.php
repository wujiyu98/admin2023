<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
