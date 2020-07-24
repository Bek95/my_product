<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

    protected $dates = ['deleted_at'];
}
