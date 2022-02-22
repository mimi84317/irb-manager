<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\showData;
use SebastianBergmann\Environment\Console;
use App\Login_log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

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

        //須迴避機構+提醒主審+行政人員備註
        $remarkTableName = "irbProjectRemark";
        $remarkCondition = "where txtAppNo='".$txtAppNo."'";
        $remarkResponse = $this->DBData($remarkTableName, $remarkCondition, $state, $obj);

        //上傳檔案
        /*$fileTableName = "IRB_filepool";
        $filePath = "/test/example/projectRemark/".$txtAppNo;//開發區
        $fileCondition = "where path='".$filePath."'";*/
        $fileTableName = "irbProjectRemarkFile";
        $fileCondition = "where txtAppNo='".$txtAppNo."' order by Id";
        $fileResponse = $this->DBData($fileTableName, $fileCondition, $state, $obj);

        //return $remarkResponse;
        return view('projectRemark')->with('remark', json_decode($remarkResponse->Body(), true))
                                    ->with('remarkFilelist', json_decode($fileResponse->Body(), true));
    }

    public function updateprojectRemark(Request $request)
    {
        $update = $request->update;
        $table = $request->table;

        if($table == "irbProjectRemark"){
            $remarkType = $request->type;
            if($remarkType == "update"){
                $remarkCondition = $request->condition;
            }
            else if($remarkType == "insert"){
                $remarkCondition = "";
            }

            $projectRemarkUpdate = json_encode($update, JSON_UNESCAPED_UNICODE);
            $projectRemarkResponse = $this->DBData($table, $remarkCondition, $remarkType, $projectRemarkUpdate);
            if(strpos($projectRemarkResponse ,'Success') == false){
                return $projectRemarkResponse;
            }
            else{
                return 0;
            }
        }
        else if($table == "irbProjectRemarkFile"){
            //更新+新增
            if($update != ""){
                $fileUpdateCount = count($update);
                for($i = 0; $i < $fileUpdateCount; $i++){
                    $time = Carbon::now();
                    $updateDate = $time->format('Y/m/d');
                    $update[$i]['update_time'] = $updateDate;
                    $fileCondition = "";

                    if($update[$i]['Id'] != ""){
                        $fileCondition = "where Id=".$update[$i]['Id'];
                        $filetType = "update";
                    }
                    else if($update[$i]['Id'] == ""){
                        $fileCondition = "";
                        $filetType = "insert";
                    }
                    unset($update[$i]['Id']);
                    $fileUpdate = json_encode($update[$i], JSON_UNESCAPED_UNICODE);
                    $fileResponse = $this->DBData($table, $fileCondition, $filetType, $fileUpdate);
                    if(strpos($fileResponse ,'Success') == false){
                        return $fileResponse;
                    }
                }
            }

            //刪除
            $deleteID = $request->deleteID;
            if($deleteID != ""){
                $deleteCount = count($deleteID);
                for($i = 0; $i < $deleteCount; $i++){
                    $deleteCondition = "where Id = ".$deleteID[$i];
                    $deleteState = "delete";
                    $deleteResponse = $this->DBData($table, $deleteCondition, $deleteState, null);
                    if(strpos($deleteResponse ,'Success') == false){
                        return $deleteResponse;
                    }
                }
            }

            return 0;

        }
    }

    public function fileDownloadRemarkFile($txtAppNo, $filename)
    {
        // append file path to filename
        $path = auth()->payload()->get('clientid').'/'.'projectRemark/'.$txtAppNo.'/'.$filename;

        // download file
        if(Storage::disk('filepool')->exists($path))
        {
            return Storage::disk('filepool')->download($path);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        return view('notFound', ['var' => $path]);
    }

    public function fileUploadPost(Request $request)
    {
        // $count = $request->get('fileAndDescriptionCount');
        $description = $request->get('description'); // assign array of descriptions
        $fieldNames = $request->get('fieldName');
        $files = $request->file('files');
        //$files = json_decode($request->get('fileList'));

        $clientid = auth()->payload()->get('clientid');
        $owner = auth()->payload()->get('owner');
        $ansid = auth()->payload()->get('ansid');
        $txtAppNo = $_POST['txtAppNo'];

        $memid = $request->get('memid');

        foreach($files as $key => $val)
        {
            $file = $files[$key];
            if ($file->isValid()) {
                $fileName = $file->getClientOriginalName();
                //$path = "\\test\\projectRemark\\".$txtAppNo;
                $path = "/test/projectRemark/".$txtAppNo;

                $fileID = Storage::disk('filepool')->putFileAs($path, $file, $fileName);

                // write data to BPM API DB
                $table = "IRB_filepool";
                $condition = "";
                $state = "insert";
                $obj = '{"file_id":"'.$fileID.'",'.
                        '"ansid":"'.$ansid.'",'.
                        '"irb_number":"",'.
                        '"file_name":"'.$fileName.'",'.
                        '"path":"'.$path.'",'.
                        '"updated_time":"'.time().'",'.
                        '"uploader":"'.$memid.'",'.
                        '"description":"'.$description[$key].'",'.
                        '"field_name":"'.$fieldNames[$key].'"'.
                        '}';
                //return $obj;
                $response = $this->DBData($table, $condition, $state, $obj);

                if($response=='Insert Failed')
                {
                    return Response()->json([
                        'success' => false
                    ]);
                }
            }
            else {
                // handle error here
                // return back()
                //     ->with('fail','There were some problems.');
                return Response()->json([
                    'success' => false
                ]);
            }
        }
        // return back()
        //             ->with('success','You have successfully upload file.')
        //             ->with('file',$fileName)
        return Response()->json([
            "success" => true
        ]);
    }
}
