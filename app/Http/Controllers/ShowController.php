<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\showData;
use SebastianBergmann\Environment\Console;

class ShowController extends Controller
{
    use showData;
    public function showFileuploadlist()
    {
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
       
        return view('uploadFilelist', compact('case') )
                        ->with('newFilelist', json_decode($newcaseResponse->Body(), true))
                        ->with('midFilelist', json_decode($midcaseResponse->Body(), true))
                        ->with('closedFilelist', json_decode($closedcaseResponse->Body(), true))
                        ->with('fixFilelist', json_decode($fixcaseResponse->Body(), true))
                        ->with('abnormalFilelist', json_decode($abnormalcaseResponse->Body(), true))
                        ->with('modifiedDateList', json_decode($modifiedDateResponse->Body(), true));

    }
    
    public function showFileuploadlistSetting($caseType){
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
}
