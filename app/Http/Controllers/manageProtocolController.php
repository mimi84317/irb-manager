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


class manageProtocolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showmanageProtocol(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = $request->condition;
        /*if($condition == ""){
            $condition = "where status = 'newcase'";
        }*/
        $obj = "";

        $tableName = "irbProject";
        $response = $this->DBData($tableName, $condition, $state, $obj);


        return view('manageProtocol')->with('projectList', json_decode($response->Body(), true));


    }

    //更新iIRB No.、其他計畫編號(衛署計畫編號、JIRB編號、科技部編號...)
    public function updatetxtField(Request $request)
    {
        $updateValue = $request->updateValue;
        $updateType = "update";
        $tableName = "irbProject";
        $condition = $request->condition;

        $updateValue = json_encode($updateValue, JSON_UNESCAPED_UNICODE);
        $response = $this->DBData($tableName, $condition, $updateType, $updateValue);
        if(strpos($response ,'Success') == false){
            return $response;
        }
        else{
            return 0;
        }
    }
}
