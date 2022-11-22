<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $fillable = ['vat','profit','shipping','created_at','updated_at'];
}