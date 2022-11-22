<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model
{
    protected $fillable = ['customer_id','product_id','is_deleted','created_at','updated_at'];
    
    public function products()
    {
        return $this->belongsTo('\App\Product','product_id');
    }
}

