<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_id','transaction_id','customer_id','first_name','last_name','email','phone','city','address','shipping_note','shipping_cost','sub_total','discount','grand_total','status','created_at','updated_at'];

    public function order_details()
    {
        return $this->hasMany('\App\OrderDetail','order_id');
    }

    public function customer_details()
    {
        return $this->hasMany('\App\Customer','id');
    }
}

