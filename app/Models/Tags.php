<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name', 'slug'];
    protected $table = 'tags';
    public function posts()
    {
        return $this->belongsToMany('App\Models\Posts');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
