<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customer_id','address','city','shipping_note','latitude','longitude','status','is_deleted','created_at','updated_at'];

    public function customer_address()
    {
	    return $this->belongsTo('\App\Customer','customer_id');
	}
}

