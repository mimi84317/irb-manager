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


class FileuploadlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use showData;
    public function showFileuploadlist(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        $state = "select";
        $condition = $request->condition;
        $obj = "";

        //新案審查
        $newcase = "IRB_new_case_upload_filelist";
        $newcaseResponse = $this->DBData($newcase,$condition, $state, $obj);

        //期中審查
        $midcase = "IRB_midterm_upload_filelist";
        $midcaseResponse = $this->DBData($midcase,$condition, $state, $obj);

        //結案審查
        $closedcase = "IRB_closed_case_upload_filelist";
        $closedcaseResponse = $this->DBData($closedcase,$condition, $state, $obj);

        //修正審查
        $fixcase = "IRB_fix_upload_filelist";
        $fixcaseResponse = $this->DBData($fixcase,$condition, $state, $obj);

        //異常審查(院內)
        $abnormalcase = "IRB_abnormal_upload_filelist";
        $abnormalcaseResponse = $this->DBData($abnormalcase,$condition, $state, $obj);

        //建立/修改日期
        $modifiedDateTable = "IRB_upload_filelist_content";
        $modifiedDateResponse = $this->DBData($modifiedDateTable,$condition, $state, $obj);

        return view('uploadFilelist')
                        ->with('newFilelist', json_decode($newcaseResponse->Body(), true))
                        ->with('midFilelist', json_decode($midcaseResponse->Body(), true))
                        ->with('closedFilelist', json_decode($closedcaseResponse->Body(), true))
                        ->with('fixFilelist', json_decode($fixcaseResponse->Body(), true))
                        ->with('abnormalFilelist', json_decode($abnormalcaseResponse->Body(), true))
                        ->with('modifiedDateList', json_decode($modifiedDateResponse->Body(), true));

    }

    public function showFileuploadlistSetting($caseType, Request $request){
        $data['caseType'] = $caseType;
        $showCase = "";
        $caseTableName = "";
        $caseCondition = $request->condition;
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

    public function updateFileuploadlistSetting(Request $request)
    {
        $caseType = $request->caseType;

        //更新上傳清單
        $filelistUpdate = $request->filelistUpdate;
        $caseTableName = "";
        $caseCondition = "";
        $caseState = "";

        //更新送審須知+更新時間
        $contentUpdate = $request->contentUpdate;
        $filelistTableName = "IRB_upload_filelist_content";
        $typeName = "";
        $contentCondition = "";
        $contentState = "update";

        $time = Carbon::now();
        $updateDate = $time->format('Y/m/d');

        switch($caseType){
            case 'newcase':
                $caseTableName = "IRB_new_case_upload_filelist";
                $typeName = "新案審查";
                break;
            case 'midcase':
                $caseTableName = "IRB_midterm_upload_filelist";
                $typeName = "期中審查";
                break;
            case 'closedcase':
                $caseTableName = "IRB_closed_case_upload_filelist";
                $typeName = "結案審查";
                break;
            case 'fixcase':
                $caseTableName = "IRB_fix_upload_filelist";
                $typeName = "修正審查";
                break;
            case 'abnormalcase':
                $caseTableName = "IRB_abnormal_upload_filelist";
                $typeName = "異常審查(院內)";
                 break;
            default:

                return view('notFound', ['var' => '案件類別'.$caseType]);
        }

        //更新上傳清單
        $searchOldDataCondition = "";
        $searchOldDataState = "select";
        $searchOldDataObj = "";
        $searchOldData = $this->DBData($caseTableName, $searchOldDataCondition, $searchOldDataState, $searchOldDataObj);

        $oldDatacount = count(json_decode($searchOldData, JSON_UNESCAPED_UNICODE));
        $newDataCount = count($filelistUpdate);

        $caseResponse = "";
        $contentResponse = "";

        //舊資料數>新資料數 => 刪除多於舊資料，其餘更新
        if($oldDatacount > $newDataCount){
            for($i = 0; $i < $oldDatacount; $i++){
                //更新
                if($i < $newDataCount){
                    $caseCondition = "where sort='".$filelistUpdate[$i]['sort']."'";
                    $filelistUpdate[$i] = json_encode($filelistUpdate[$i], JSON_UNESCAPED_UNICODE);
                    $caseState = "update";
                    $caseResponse = $this->DBData($caseTableName, $caseCondition, $caseState, $filelistUpdate[$i]);
                }
                //刪除
                else{
                    $caseCondition = "where sort='".$searchOldData[$i]['sort']."'";
                    $caseState = "delete";
                    $caseResponse = $this->DBData($caseTableName, $caseCondition, $caseState, null);
                }
                /*if(strpos($caseResponse ,' ') == false){
                    return $caseResponse;
                }*/
            }
        }
        //舊資料數<新資料數 => 新增新資料，其餘更新
        else{
            for($i = 0; $i < $newDataCount; $i++){
                //更新
                if($i < $oldDatacount){
                    $caseCondition = "where sort='".$filelistUpdate[$i]['sort']."'";
                    $filelistUpdate[$i] = json_encode($filelistUpdate[$i], JSON_UNESCAPED_UNICODE);
                    $caseState = "update";
                    $caseResponse = $this->DBData($caseTableName, $caseCondition, $caseState, $filelistUpdate[$i]);
                }
                //新增
                else{
                    $caseCondition = "";
                    $caseState = "insert";
                    $filelistUpdate[$i] = json_encode($filelistUpdate[$i], JSON_UNESCAPED_UNICODE);
                    $caseResponse = $this->DBData($caseTableName, $caseCondition, $caseState, $filelistUpdate[$i]);
                }
                if(strpos($caseResponse ,'Success') == false){
                    return $caseResponse;
                }
            }
        }

        //更新送審須知+更新時間
        $contentUpdate['modified_date'] = $updateDate;
        $contentUpdate = json_encode($contentUpdate, JSON_UNESCAPED_UNICODE);
        $contentCondition = "where type_name='".$typeName."'";
        $contentResponse = $this->DBData($filelistTableName, $contentCondition, $contentState, $contentUpdate);
        if(strpos($contentResponse ,'Success') == false){
            return $contentResponse;
        }

        return 0;
    }

}
