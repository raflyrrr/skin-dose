<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Posts extends Model
{
    use SoftDeletes;
    protected $fillable = ['namaproduk', 'category_id', 'content', 'gambar', 'ingrenot', 'slug', 'users_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredients');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getProductByCart($id)
    {
        return self::where('id', $id)->get()->toArray();
    }
}
