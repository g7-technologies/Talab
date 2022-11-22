<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['text','notification_by','read_status','created_at','updated_at'];

    public function notification_by()
    {
	    return $this->belongsTo('\App\Shop','notification_by');
	}
}

