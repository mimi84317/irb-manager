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


class manageFlowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showmanageFlow(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $projectCondition = $request->condition;
        $obj = "";

        $projectTableName = "irbProject";
        $projectResponse = $this->DBData($projectTableName, $projectCondition, $state, $obj);

        $projectResponse = json_decode($projectResponse, true);

        $recordResult = [];

        for($i = 0; $i < sizeof($projectResponse); $i++){
            $recordCondition = "where number = '".$projectResponse[$i]['txtAppNo']."'";
            $recordTableName = "irbRecord";
            $recordResponse = $this->DBData($recordTableName, $recordCondition, $state, $obj);
            $recordResponse = json_decode($recordResponse, true);

            if(sizeof($recordResponse) > 0){
                array_push($recordResult, $recordResponse[sizeof($recordResponse)-1]);
            }
            else{
                array_push($recordResult, $recordResponse);
            }
        }

        return view('manageFlow')->with('projectList', $projectResponse)
                                ->with('recordResultList', $recordResult);
    }

}
