<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    public function service_center()
    {
        return $this->hasMany('App\Models\ServiceCenter');
    }
}
