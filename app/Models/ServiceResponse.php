<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceResponse extends Model
{
    public function service_request()
    {
        return $this->belongsTo('App\Models\ServiceRequest');
    }
}
