<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\showData;
use SebastianBergmann\Environment\Console;

class UpdateController extends Controller
{
    use showData;
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
        $filelistTableNmae = "IRB_upload_filelist_content";
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
                if(strpos($caseResponse ,' ') == false){
                    return $caseResponse;
                }
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
        $contentResponse = $this->DBData($filelistTableNmae, $contentCondition, $contentState, $contentUpdate);
        if(strpos($contentResponse ,'Success') == false){
            return $contentResponse;
        }

        return 0;
    }
    
}
