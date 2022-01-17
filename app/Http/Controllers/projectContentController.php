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

        //依流水號搜尋唯一案件
        $projectCondition = $request->condition;
        $projectResponse = $this->DBData($tableName, $projectCondition, $state, $obj);

        //依iIRB No搜尋同系列案件
        $projectResponse = json_decode($projectResponse, true);
        $txtReviewNo = $projectResponse[0]['txtReviewNo'];
        $listCondition = "where txtReviewNo='".$txtReviewNo."'";
        $listResponse = $this->DBData($tableName, $listCondition, $state, $obj);

        return view('projectContent')->with('project', $projectResponse)
                                    ->with('projectList', json_decode($listResponse->Body(), true));
        //return view('projectContent');


    }

}
