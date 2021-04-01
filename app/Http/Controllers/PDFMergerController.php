<?php

use App\Http\Controllers\Controller;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class PDFMergerController extends Controller{
    public function pdfMerge($dir, $memid, $ans){

        $file = glob($dir."/*pdf");

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

