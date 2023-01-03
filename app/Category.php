<?php

namespace App;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use ModelTree;
    protected $dateFormat = 'Y-m-d H:i:s.u';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setOrderColumn('sort_order');
        $this->setTitleColumn('name');
    }
}
