<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = ['shop_id','no_of_product','status','created_at','updated_at'];

    public function shop()
    {
        return $this->belongsTo('\App\Shop','shop_id');
    }
}