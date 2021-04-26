<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Login_log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
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
    public function login()
    {
        $credentials = request(['clientid', 'client_secret']);
        $username = request('username');
        $clientid = $credentials['clientid'];

        // add username to custom claims
        auth()->claims(['username' => $username]);

        if (! $token = auth()->attempt($credentials)) {
            // insert log success or not
            $this->insertLoginLog($clientid, $username, false);
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // insert log success or not
        $dbret = $this->insertLoginLog($clientid, $username, true);
        return $this->respondWithToken($token, $username, $dbret);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // return response()->json(auth()->user());

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
        switch($case)
        {
            case 'newcase':
                //upload filelist left join filepool
                $response = Http::asForm()->withHeaders([
                    'Accept' => 'application/json'
                ])->post($bpmapi, [
                    'funName' => 'callDBApi',
                    'Data' => '{"DB":"BPM","TbName":"IRB_new_case_upload_filelist","condition":" LEFT JOIN (SELECT * FROM IRB_filepool WHERE ansid = \''.$ansid.'\') AS Temp ON IRB_new_case_upload_filelist.chname = Temp.field_name ORDER BY sort ","statements":"select"}',
                    'conArr' => '{}',
                    'column' => ''
                ]);
                $caseType = '新案';
                break;
            case 'midterm':
                //upload filelist left join filepool
                $response = Http::asForm()->withHeaders([
                    'Accept' => 'application/json'
                ])->post($bpmapi, [
                    'funName' => 'callDBApi',
                    'Data' => '{"DB":"BPM","TbName":"IRB_midterm_upload_filelist","condition":" LEFT JOIN (SELECT * FROM IRB_filepool WHERE ansid = \''.$ansid.'\') AS Temp ON IRB_midterm_upload_filelist.chname = Temp.field_name ORDER BY sort ","statements":"select"}',
                    'conArr' => '{}',
                    'column' => ''
                ]);
                $caseType = '期中';
                break;
            default:
                // $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
                // $response = Http::asForm()->withHeaders([
                //     'Accept' => 'application/json'
                // ])->post($bpmapi, [
                //     'funName' => 'callDBApi',
                //     'Data' => '{"DB":"BPM","TbName":"IRB_new_case_upload_filelist","condition":" ORDER BY sort","statements":"select"}',
                //     'conArr' => '{}',
                //     'column' => ''
                // ]);
                // $httpcode = $response->status();
                // return view('newCaseFilelist', compact('username', 'user', 'clientid', 'httpcode', 'case', 'ansid') )->with('filelist', json_decode($response->Body(), true));
                return view('notFound', ['var' => '案件類別'.$case]);
        }

        $httpcode = $response->status();

        // get files in disk but not in db
        $path = $this->checkDir($owner, $ansid);
        $disk_files = Storage::disk('filepool')->allFiles($path);
        $db_files = json_decode($response->Body(), true);
        $result_array = $disk_files;

        foreach($db_files as $file)
        {
            if(in_array( $file['file_id'], $disk_files))
            {
                $result_array = array_diff( $result_array, [$file['file_id']] );
            }
        }
        $size = 0;

        if(Storage::disk('filepool')->exists($path.'/'.$owner.'_'.$ansid.'.pdf'))
        {
            $size = Storage::disk('filepool')->size($path.'/'.$owner.'_'.$ansid.'.pdf');
            $size = $this->humanFileSize($size);
        }

        return view('newCaseFilelist', compact('token', 'expireTime', 'username', 'user', 'clientid', 'httpcode', 'case', 'caseType', 'ansid', 'owner') )
                        ->with('filelist', json_decode($response->Body(), true))
                        ->with('diffFilelist', $result_array)
                        ->with('size', $size);

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
        $username = auth()->payload()->get('username');
        $this->insertLogoutLog($clientid, $username);

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
        return $this->respondWithToken(auth()->refresh(), 'refresh test', false);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $username, $dbret)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'username' => $username,
            'dbret' => $dbret
        ]);
    }

    /**
     * Insert log to database.
     *
     * @return bool
     */
    protected function insertLoginLog($clientid, $username, $isSuccess)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => ($isSuccess? 1 : 2) //event type id => login sucess : 1 , fail : 2
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertLogoutLog($clientid, $username)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => 4 //event type id => logout : 4
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

    protected function insertAccessLog($clientid, $username)
    {
        $data = [
            'clientid' => $clientid,
            'username' => $username,
            'event_type_id' => 5 //event type id => access : 5
        ];
        $ret = Login_log::create($data);
        if($ret)
        {
            return true;
        }
        return false;
    }

}
