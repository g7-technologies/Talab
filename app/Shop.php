<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop extends Authenticatable
{
    protected $fillable = ['name', 'logo', 'registration_no', 'trader_name', 'email', 'password', 'number', 'city', 'profit', 'always_open', 'no_of_product', 'iban', 'vat', 'delivery', 'minimum_cost_to_delivery', 'verified', 'albalad', 'shop_open','token', 'status', 'is_deleted', 'created_at','updated_at'];

    protected $hidden = ['password','token'];

    public function shop_timings()
    {
	    return $this->hasMany('\App\ShopTimings','shop_id');
	}

    protected $with = ['category'];

    public function category()
    {
        return $this->hasMany('\App\Category','shop_id');
    }
}

