<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['name','status','is_deleted','created_at','updated_at'];
}