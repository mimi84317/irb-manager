<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Login_log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['clientid', 'client_secret']);
        $username = request('username');
        $clientid = $credentials['clientid'];

        // add username to custom claims
        auth()->claims(['username' => $username]);

        if (! $token = auth()->attempt($credentials)) {
            // insert log success or not
            $this->insertLoginLog($clientid, $username, false);
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // insert log success or not
        $dbret = $this->insertLoginLog($clientid, $username, true);
        return $this->respondWithToken($token, $username, $dbret);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // return response()->json(auth()->user());

        // insert to log
        $clientid = auth()->payload()->get('clientid');
        $username = auth()->payload()->get('username');
        $this->insertAccessLog($clientid, $username);
        return view('newCaseFilelist', ['username'=> $username, 'clientid'=> $clientid] );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // insert to log
        $clientid = auth()->payload()->get('clientid');
        $username = auth()->payload()->get('username');
        $this->insertLogoutLog($clientid, $username);

        // logout
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(), 'refresh test', false);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $username, $dbret)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'username' => $username,
            'dbret' => $dbret
        ]);
    }

    /**
     * Insert log to database.
     *
     * @return bool
     */
    protected function insertLoginLog($clientid, $username, $isSuccess)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => ($isSuccess? 1 : 2) //event type id => login sucess : 1 , fail : 2
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertLogoutLog($clientid, $username)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => 4 //event type id => logout : 4
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertAccessLog($clientid, $username)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => 5 //event type id => access : 5
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }
}
