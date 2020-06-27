<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getFile($filename)
    {
        return response()->download(storage_path('app/' . $filename), null, [], null);
    }
}
