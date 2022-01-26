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


class projectContentController extends Controller
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

}
