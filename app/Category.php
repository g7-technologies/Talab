<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','shop_id','verified','status','is_deleted','created_at','updated_at'];

    protected $with = ['products'];

    public function products()
    {
	    return $this->hasMany('\App\Product','category_id');
	}
}

