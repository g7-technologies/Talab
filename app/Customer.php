<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    protected $fillable = ['first_name','last_name','email','password','number','image','default_address','token','is_deleted','status','created_at','updated_at'];
    protected $hidden = ['password','token'];

    public function addresses()
    {
        return $this->hasMany('\App\Address','customer_id');
    }

    public function orders()
    {
        return $this->hasMany('\App\Order','customer_id');
    }

}

