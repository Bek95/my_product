<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    protected $dates = ['deleted_at'];
}
