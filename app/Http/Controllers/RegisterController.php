<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegisterController extends Controller
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'clientid' => 'required',
            'client_secret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errorFlag' => '404'], 401);
        }
        try {
            $user = User::create([
                "name" => $request->name,
                "clientid" => $request->clientid,
                "client_secret" => bcrypt($request->client_secret),
            ]);
        } catch (\Exception $e) {
            return response()->json(['errorFlag' => '1'], 401);
        }
       return response()->json(['errorFlag' => '0'], 201); //201 Created
    }

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function register(Request $request)
    // {
    //     $rules = [
    //         'name' => 'unique:users|required',
    //         'email'    => 'unique:users|required',
    //         'password' => 'required',
    //     ];

    //     $input     = $request->only('name', 'email', 'password');
    //     $validator = Validator::make($input, $rules);

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'error' => $validator->messages()]);
    //     }
    //     $name = $request->name;
    //     $email    = $request->email;
    //     $password = $request->password;
    //     $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
    // }
}
