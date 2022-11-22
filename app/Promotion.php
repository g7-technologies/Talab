<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['code','discount','by_admin','valid_till','promotion_type','status','is_deleted','created_at','updated_at'];
}