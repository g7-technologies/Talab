<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ShopTimings extends Model
{
    protected $fillable = ['shop_id','monday_open','monday_close','tuesday_open','tuesday_close','wednesday_open','wednesday_close','thursday_open','thursday_close','friday_open','friday_close','saturday_open','saturday_close','sunday_open','sunday_close','created_at','updated_at'];
}

