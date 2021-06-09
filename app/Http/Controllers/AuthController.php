<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Login_log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Traits\CheckDir;
use App\Traits\showData;

class AuthController extends Controller
{
    //use CheckDir;
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
    public function login($case= null, $ansid= null, $owner= null)
    {
        $credentials = request(['clientid', 'client_secret']);
        $username = request('username');
        $user = request('user');
        $clientid = $credentials['clientid'];

        if ($owner==null)
        {
            $owner = $user;
        }

        // add custom claims
        auth()->claims([
            'username' => $username,
            'user' => $user,
            'case' => $case,
            'ansid'=> $ansid,
            'owner'=> $owner
            ]);

        if (! $token = auth()->attempt($credentials)) { // get a JWT
            // insert log success or not
            $this->insertLoginLog($clientid, $user, false);
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // insert log success or not
        $dbret = $this->insertLoginLog($clientid, $user, true);
        return $this->respondWithToken($token, $username, $dbret);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    use showData;
    public function me()
    {
        // return response()->json(auth()->user());

    }
    public function showFileuploadlist()
    {
        // insert to log
        $clientid = auth()->payload()->get('clientid');
        $user = auth()->payload()->get('user');
        $username = auth()->payload()->get('username');
        $this->insertAccessLog($clientid, $user);

        $case = auth()->payload()->get('case');
        $caseType = 'UNKNOWN';
        $ansid = auth()->payload()->get('ansid');
        $owner = auth()->payload()->get('owner');
        $token = request('token');
        $expireTime = auth()->payload()->get('exp');

        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = "";
        $obj = "";
        $state = "select";
        $condition = "";
        $obj = "";

        //新案審查
        $newCase = "IRB_new_case_upload_filelist";
        $newcaseResponse = $this->DBData($newCase,$condition, $state, $obj);

        //期中審查
        $midCase = "IRB_midterm_upload_filelist";
        $midcaseResponse = $this->DBData($midCase,$condition, $state, $obj);

        //結案審查
        $closedCase = "IRB_closed_case_upload_filelist";
        $closedcaseResponse = $this->DBData($closedCase,$condition, $state, $obj);

        //修正審查
        $fixCase = "IRB_fix_upload_filelist";
        $fixcaseResponse = $this->DBData($fixCase,$condition, $state, $obj);

        //異常審查(院內)
        $abnormalCase = "IRB_abnormal_upload_filelist";
        $abnormalcaseResponse = $this->DBData($abnormalCase,$condition, $state, $obj);

        //建立/修改日期
        $modifiedDateTable = "IRB_upload_filelist_content";
        $modifiedDateResponse = $this->DBData($modifiedDateTable,$condition, $state, $obj);

        return view('uploadFilelist' )
                        ->with('newFilelist', json_decode($newcaseResponse->Body(), true))
                        ->with('midFilelist', json_decode($midcaseResponse->Body(), true))
                        ->with('closedFilelist', json_decode($closedcaseResponse->Body(), true))
                        ->with('fixFilelist', json_decode($fixcaseResponse->Body(), true))
                        ->with('abnormalFilelist', json_decode($abnormalcaseResponse->Body(), true))
                        ->with('modifiedDateList', json_decode($modifiedDateResponse->Body(), true));


        //return view('welcome');

    }

    public function showFileuploadlistSetting($caseType)
    {
        // insert to log
        $clientid = auth()->payload()->get('clientid');
        $user = auth()->payload()->get('user');
        $username = auth()->payload()->get('username');
        $this->insertAccessLog($clientid, $user);

        $case = auth()->payload()->get('case');
        $caseType = 'UNKNOWN';
        $ansid = auth()->payload()->get('ansid');
        $owner = auth()->payload()->get('owner');
        $token = request('token');
        $expireTime = auth()->payload()->get('exp');

        $data['caseType'] = $caseType;
        $showCase = "";
        $caseTableName = "";
        $caseCondition = "";
        $state = "select";
        $obj = "";
        switch($caseType){
            case 'newcase':
                $showCase = "新案審查";
                $caseTableName = "IRB_new_case_upload_filelist";
                break;
            case 'midcase':
                $showCase = "期中審查";
                $caseTableName = "IRB_midterm_upload_filelist";
                break;
            case 'closedcase':
                $showCase = "結案審查";
                $caseTableName = "IRB_closed_case_upload_filelist";
                break;
            case 'fixcase':
                $showCase = "修正審查";
                $caseTableName = "IRB_fix_upload_filelist";
                break;
            case 'abnormalcase':
                $showCase = "異常審查(院內)";
                $caseTableName = "IRB_abnormal_upload_filelist";
                 break;
            default:

                return view('notFound', ['var' => '案件類別'.$caseType]);

        }
        $caseResponse = $this->DBData($caseTableName, $caseCondition, $state, $obj);

        $contentRableName = "IRB_upload_filelist_content";
        $contentCondition = "where type_name='".$showCase."'";
        $contentResponse = $this->DBData($contentRableName, $contentCondition, $state, $obj);

        return view('uploadFileListSetting', compact('caseType') )
                    ->with('showCase', $showCase)
                    ->with('caseList', json_decode($caseResponse->Body(), true))
                    ->with('caseContent', json_decode($contentResponse->Body(), true));
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
        $user = auth()->payload()->get('user');
        $this->insertLogoutLog($clientid, $user);

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
        return $this->respondWithToken(auth()->refresh(), 'refresh', true);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user, $dbret)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
            'dbret' => $dbret
        ]);
    }

    /**
     * Insert log to database.
     *
     * @return bool
     */
    protected function insertLoginLog($clientid, $user, $isSuccess)
    {
        $data = [
            'clientid' => $clientid,
            'user' => $user,
            'event_type_id' => ($isSuccess? 1 : 2) //event type id => login sucess : 1 , fail : 2
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertLogoutLog($clientid, $user)
    {
        $data = [
            'clientid' => $clientid,
            'user' => $user,
            'event_type_id' => 4 //event type id => logout : 4
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertAccessLog($clientid, $user)
    {
        $data = [
            'clientid' => $clientid,
            'user' => $user,
            'event_type_id' => 5 //event type id => access : 5
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    // code from : https://stackoverflow.com/questions/15188033/human-readable-file-size
    protected function humanFileSize($size,$unit="") {
        if( (!$unit && $size >= 1<<30) || $unit == "GB")
          return number_format($size/(1<<30),2)."GB";
        if( (!$unit && $size >= 1<<20) || $unit == "MB")
          return number_format($size/(1<<20),2)."MB";
        if( (!$unit && $size >= 1<<10) || $unit == "KB")
          return number_format($size/(1<<10),2)."KB";
        return number_format($size)." bytes";
      }
}
