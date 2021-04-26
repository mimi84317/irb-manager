<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\showData;

class ShowController extends Controller
{
    use showData;
    public function showFileuploadlist()
    {
        //新案審查
        $newCase = "IRB_new_case_upload_filelist";
        $newcaseResponse = $this->showDBData($newCase);

        //期中審查
        $midCase = "IRB_midterm_upload_filelist";
        $midcaseResponse = $this->showDBData($midCase);

        //結案審查
        $closedCase = "IRB_closed_case_upload_filelist";
        $closedcaseResponse = $this->showDBData($closedCase);

        //修正審查
        $fixCase = "IRB_fix_upload_filelist";
        $fixcaseResponse = $this->showDBData($fixCase);

        //異常審查(院內)
        $abnormalCase = "IRB_abnormal_upload_filelist";
        $abnormalcaseResponse = $this->showDBData($abnormalCase);

        //建立/修改日期
        $modifiedDateTable = "IRB_upload_filelist_content";
        $modifiedDateResponse = $this->showDBData($modifiedDateTable);
       
        return view('uploadFilelist', compact('case', 'caseType') )
                        ->with('newFilelist', json_decode($newcaseResponse->Body(), true))
                        ->with('midFilelist', json_decode($midcaseResponse->Body(), true))
                        ->with('closedFilelist', json_decode($closedcaseResponse->Body(), true))
                        ->with('fixFilelist', json_decode($fixcaseResponse->Body(), true))
                        ->with('abnormalFilelist', json_decode($abnormalcaseResponse->Body(), true))
                        ->with('modifiedDateList', json_decode($modifiedDateResponse->Body(), true));

    }
    
    public function showFileuploadlistSetting($case){
        return view('uploadFileListSetting');
    }
}
