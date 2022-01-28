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


class projectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showprojectContent(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $obj = "";
        $tableName = "irbProject";

        //依案件流水號搜尋唯一案件
        $projectCondition = $request->condition;
        $projectResponse = $this->DBData($tableName, $projectCondition, $state, $obj);

        //依計畫流水號搜尋同系列案件
        $projectResponse = json_decode($projectResponse, true);
        $txtAppNo = $projectResponse[0]['txtAppNo'];
        $listCondition = "where txtAppNo='".$txtAppNo."'";
        $listResponse = $this->DBData($tableName, $listCondition, $state, $obj);

        return view('projectContent')->with('project', $projectResponse)
                                    ->with('projectList', json_decode($listResponse->Body(), true));
        //return view('projectContent');


    }

    public function showprojectRemark(Request $request)
    {
        $txtAppNo = $request->txtAppNo;
        $state = "select";
        $obj = "";
        $tableName = "irbProjectRemark";

        $condition = "where txtAppNo='".$txtAppNo."'";
        $response = $this->DBData($tableName, $condition, $state, $obj);

        //return $response;
        return view('projectRemark')->with('remark', json_decode($response->Body(), true));
    }

    public function updateprojectRemark(Request $request)
    {
        $projectRemarkUpdate = $request->projectRemarkUpdate;
        $type = $request->type;
        $tableName = "irbProjectRemark";
        if($type == "update"){
            $condition = $request->condition;
        }
        else if($type == "insert"){
            $condition = "";
        }

        $projectRemarkUpdate = json_encode($projectRemarkUpdate, JSON_UNESCAPED_UNICODE);
        $projectRemarkResponse = $this->DBData($tableName, $condition, $type, $projectRemarkUpdate);
        if(strpos($projectRemarkResponse ,'Success') == false){
            return $projectRemarkResponse;
        }
        else{
            return 0;
        }
    }


}
