<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    protected $fillable = ['name', 'slug'];
    protected $table = 'ingredients';
    public function posts()
    {
        return $this->belongsToMany('App\Models\Posts');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
