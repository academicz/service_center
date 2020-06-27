<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\ServiceCenter;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getServiceCenter()
    {
        if (Auth::check() && Auth::user()->role == Constants::$SERVICE_CENTER_USER) {
            return ServiceCenter::findOrFail(Auth::user()->user_id);
        }
        return abort('405');
    }
}
