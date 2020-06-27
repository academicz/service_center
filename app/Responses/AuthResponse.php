<?php

namespace App\Responses;


use Illuminate\Support\Facades\Auth;

class AuthResponse
{
    private $data,$status;

    /**
     * AuthResponse constructor.
     * @param $data
     * @param $status
     */
    public function __construct($data, $status)
    {
        $this->data = $data;
        $this->status = $status;
    }


    public function send()
    {
        if (Auth::check()) {
            return response([], 403);
        } else {
            return response([], 200);
        }
    }
}