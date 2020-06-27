<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    public function registration()
    {
        return $this->belongsTo('App\Models\Registration');
    }

    public function service_request_images()
    {
        return $this->hasMany('App\Models\ServiceRequestImage');
    }
    public function service_response()
    {
        return $this->hasOne('App\Models\ServiceResponse');
    }
    public function return_info()
    {
        return $this->hasOne('App\Models\ReturnInfo');
    }
    public function bill()
    {
        return $this->hasOne('App\Models\Bill');
    }
    public function service_center()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }
}
