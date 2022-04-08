<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\showData;
use SebastianBergmann\Environment\Console;
use App\Login_log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Product;


class manageNotOngoingProtocolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showmanageNotOngoingProtocol(Request $request)
    {

        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';

        //$time = Carbon::now();

        $state = "select";
        $condition = $request->condition;
        //$condition = "where cast(Duraton_end as datetime) < '".$time."'";
        //return $condition;
        $obj = "";

        $tableName = "irbProject";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        return view('manageNotOngoingProtocol')->with('projectList', json_decode($response->Body(), true));
    }

}
