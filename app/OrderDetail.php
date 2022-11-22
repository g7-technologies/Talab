<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id','shop_id','product_id','quantity','price','profit','discount_percentage','created_at','updated_at'];

    protected $with = ['products'];

    public function products()
    {
        return $this->belongsTo('\App\Product','product_id');
    }

    public function order()
    {
        return $this->belongsTo('\App\Order','order_id');
    }
}