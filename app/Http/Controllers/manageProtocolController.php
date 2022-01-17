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
        $obj = "";

        $tableName = "irbProject";
        $response = $this->DBData($tableName, $condition, $state, $obj);


        return view('manageProtocol')->with('projectList', json_decode($response->Body(), true));


    }

    //更新iIRB No.
    public function updatetxtReviewNo(Request $request)
    {
        $txtReviewNoeUpdate = $request->txtReviewNoUpdate;
        $updateType = $request->updateType;
        $tableName = "irbProject";
        $condition = $request->condition;

        $txtReviewNoeUpdate = json_encode($txtReviewNoeUpdate, JSON_UNESCAPED_UNICODE);
        $txtReviewNoeesponse = $this->DBData($tableName, $condition, $updateType, $txtReviewNoeUpdate);
        if(strpos($txtReviewNoeesponse ,'Success') == false){
            return $txtReviewNoeesponse;
        }
        else{
            return 0;
        }
    }

}
