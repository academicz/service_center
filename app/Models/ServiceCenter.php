<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCenter extends Model
{
    public function shop_type()
    {
        return $this->belongsTo('App\Models\ShopType');
    }
    public function shop_images()
    {
        return $this->hasMany('App\Models\ShopImage','service_center_id');
    }
    public function service_request()
    {
        return $this->hasMany('App\Models\ServiceRequest');
    }
}
