<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * redirect when JWT invalid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function invalid()
    {
        return view('exception');
    }
}
