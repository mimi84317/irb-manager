<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | alpha_dash | between:0,255',
            'clientid' => 'required | alpha_dash | between:0,255',
            'client_secret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errorFlag' => '404'], 401);
            // return response()->json(['errorMsg' => $validator->messages()], 401);
        }
        try {
            $user = User::create([
                "name" => $request->name,
                "clientid" => $request->clientid,
                "client_secret" => bcrypt($request->client_secret),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 401);
        }
       return response()->json(['success' => true], 201); //201 Created
    }
}
