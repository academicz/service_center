<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function bill_items()
    {
        return $this->hasMany('App\Models\BillItem');
    }
    public function service_request()
    {
        return $this->belongsTo('App\Models\ServiceRequest');
    }
}
