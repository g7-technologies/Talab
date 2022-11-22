<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','image','price','discount_percentage','category_id','stock','minimum_quantity','status','is_deleted','created_at','updated_at'];
}