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


class trackingInfoDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showtrackingInfoDetail(Request $request)
    {

        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $obj = "";
        $condition = $request->condition;

        $tracingTableName = "irbProjectTracing";
        $ptracingtResponse = $this->DBData($tracingTableName, $condition, $state, $obj);

        return view('trackingInfoDetail')->with('tracinglist', json_decode($ptracingtResponse->Body(), true));
        //return view('trackingInfoDetail');
    }

    public function showtracingDateSetting(Request $request)
    {

        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $obj = "";
        $condition = $request->condition;

        //依案件流水號搜尋唯一案件
        $projectTableName = "irbProject";
        $projectResponse = $this->DBData($projectTableName, $condition, $state, $obj);

        //依計畫流水號搜尋追蹤審查預定日
        $tracingTableName = "irbProjectTracing";
        $ptracingtResponse = $this->DBData($tracingTableName, $condition, $state, $obj);

        return view('tracingDateSetting')->with('project', $projectResponse)
                                         ->with('tracinglist', json_decode($ptracingtResponse->Body(), true));
    }

    public function updatetracingDateSetting(Request $request)
    {
        $tracingDatetUpdate = $request->tracingDatetUpdate;
        $tableName = "irbProjectTracing";
        $condition = "";
        $state = "";

        $count = count($tracingDatetUpdate);
        for($i = 0; $i < $count; $i++){
            if($tracingDatetUpdate[$i]['Id'] != ""){
                $state = "update";
                $condition = "where Id=".$tracingDatetUpdate[$i]['Id'];
            }
            else{
                $state = "insert";
            }
            unset($tracingDatetUpdate[$i]['Id']);
            $update = json_encode($tracingDatetUpdate[$i], JSON_UNESCAPED_UNICODE);
            $response = $this->DBData($tableName, $condition, $state, $update);

            //return $update;

            if(strpos($response ,'Success') == false){
                return $response;
            }
        }
        return 0;
    }

    public function updatetracingDateSettingSumbit(Request $request)
    {
        $tracingDatetUpdate = $request->tracingDatetUpdate;
        $tableName = "irbProjectTracing";
        $condition = "";
        $state = "";

        $count = count($tracingDatetUpdate);
        for($i = 0; $i < $count; $i++){
            if($tracingDatetUpdate[$i]['Id'] != ""){
                $state = "update";
                $condition = "where Id=".$tracingDatetUpdate[$i]['Id'];
            }
            else{
                $state = "insert";
            }
            unset($tracingDatetUpdate[$i]['Id']);
            $update = json_encode($tracingDatetUpdate[$i], JSON_UNESCAPED_UNICODE);
            $response = $this->DBData($tableName, $condition, $state, $update);

            //return $update;

            if(strpos($response ,'Success') == false){
                return $response;
            }
        }
        return 0;
    }


}
