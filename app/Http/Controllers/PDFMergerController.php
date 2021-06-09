<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\CheckDir;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Support\Facades\Storage;

class PDFMergerController extends Controller{
    use CheckDir;
    public function pdfMerge($clientid, $memid, $ans){

        $dir = $this->getDirAbsolutePath($clientid, $memid, $ans);
        // $dir = Storage::disk('filepool')->path('').$memid."/".$ans;
        // $dir = 'D:\BPM\laravel\irb\filepool/MEMC_5/MEMC_500/MEMC_5000000/ans123456';
        $file = glob($dir."/*pdf");

        // return response()->json([
        //     "file0" => $file[0]
        // ]);

        $pdfMerger = PDFMerger::init(); //Initialize the merger
        for($i = 0; $i < count($file); $i++){

            $open = fopen($file[$i], "r");
            $read = fread($open, filesize($file[$i]));

            if(stristr($read, "/Encrypt")){
                $fileName = explode ("/", $file[$i]);
                $msg = $fileName[count($fileName)-1]." 為加密檔案，請上傳無密碼保護之pdf文件";
                echo"<script>alert('$msg')</script>";
                return 0;
            }

            $pdfMerger->addPDF($file[$i]);
        }

        $pdfMerger->merge();
        $mergerFile = $dir.'/'.$memid.'_'.$ans.'.pdf';
        $pdfMerger->save($mergerFile);

        return 0;

    }
}

