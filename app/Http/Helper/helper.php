<?php
/*
 * To highlight current link
 */

use App\Constants\Constants;

function activePage($urls, $class)
{
    if (gettype($urls) != 'array')
        return route($urls) == url()->current() ? $class : '';
    foreach ($urls as $url) {
        if (route($url) == url()->current()) {
            return $class;
        }
    }
    return '';
}

/**
 * Change url string
 * @param $string
 * @return mixed
 */
function urlString($string)
{
    return str_replace(' ', '-', strtolower($string));
}

/**
 * custom json response with status
 * @param $data
 * @param $status
 * @return array
 */
function jsonResponse($data, $status)
{
    return [
        'status' => $status,
        'data' => $data,
    ];
}

/**
 * @param $path
 * @return string
 */
function privateAsset($path)
{
    return '/file/' . $path;
}

function user()
{
    if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == \App\Constants\Constants::$CUSTOMER_USER) {
        return \App\Models\Registration::findOrFail(\Illuminate\Support\Facades\Auth::user()->user_id);
    }
    return false;
}

function shop()
{
    if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == \App\Constants\Constants::$SERVICE_CENTER_USER) {
        return \App\Models\ServiceCenter::findOrFail(\Illuminate\Support\Facades\Auth::user()->user_id);
    }
    return false;
}

function formattedDate($date)
{
    return \Carbon\Carbon::parse($date)->format('d M Y');
}

function formattedTime($date)
{
    return \Carbon\Carbon::parse($date)->format('h:i a');
}

function shopList()
{
return \App\Models\ServiceCenter::where('status', Constants::$APPROVED_CENTER)->get();
}
function categories(){
    return \App\Models\ShopType::all();
}