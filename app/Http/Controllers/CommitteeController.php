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


class CommitteeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;

    //主頁顯示
    public function showCommittee(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = $request->condition;
        $obj = "";

        $tableName = "IRB_committee";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        return view('committeeHome')
                        ->with('committeeList', json_decode($response->Body(), true));

    }

    //主頁查詢
    public function searchCommittee(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $obj = "";
        $state = "select";
        $condition = $request->condition;
        $obj = "";

        $tableName = "IRB_committee";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        return view('committeeHome')
                        ->with('committeeList', json_decode($response->Body(), true));

    }

    //會議紀錄、會議內容顯示
    public function showCommitteeContent(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = $request->condition;
        $obj = "";

        $tableName = "IRB_committee";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        $committeeType = $request->committeeType;

        //會議內容
        if($committeeType == "content"){
            return view('committeeContent')->with('committeeContentList', json_decode($response->Body(), true));
        }
        //會議紀錄
        else if($committeeType == "minutes"){
            return view('committeeMinutes')->with('committeeContentList', json_decode($response->Body(), true));
        }

    }



    //更新會議紀錄、會議內容顯示
    public function updateCommittee(Request $request)
    {
        $committeeUpdate = $request->committeeUpdate;
        $updateType = $request->updateType;
        $tableName = "IRB_committee";
        if($updateType == "update"){
            $committeeCondition = $request->condition;
        }
        else if($updateType == "insert"){
            $committeeCondition = "";
        }

        $time = Carbon::now();
        $updateDate = $time->format('Y/m/d');

        $committeeUpdate['modified_date'] = $updateDate;
        $committeeUpdate = json_encode($committeeUpdate, JSON_UNESCAPED_UNICODE);
        $committeeResponse = $this->DBData($tableName, $committeeCondition, $updateType, $committeeUpdate);
        if(strpos($committeeResponse ,'Success') == false){
            return $committeeResponse;
        }
        else{
            return 0;
        }
    }

    //	討論案件清單
    public function showCommitteeList(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = $request->condition;
        $obj = "";

        $tableName = "IRB_committee";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        return view('committeeList')->with('committeeList', json_decode($response->Body(), true));
        //return view('committeeListNew')->with('committeeList', json_decode($response->Body(), true));

    }

    //刪除會議
    public function deleteCommittee(Request $request)
    {
        $committeeDelete = $request;
        $tableName = "IRB_committee";
        $committeeCondition = "";
        $committeeState = "delete";

        $committeeCondition = "where Id=".$committeeDelete['condition'];
        $committeeResponse = $this->DBData($tableName, $committeeCondition, $committeeState, null);

        if(strpos($committeeResponse ,'Success') == false){
            return $committeeResponse;
        }
        else{
            return 0;
        }


    }

}
