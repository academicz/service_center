<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function service_requests()
    {
        return $this->hasMany('App\Models\ServiceRequest');
    }
    public function login()
    {
        return $this->hasOne('App\Models\Login','user_id');
    }
}
