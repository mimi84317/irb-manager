<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CheckDirController extends Controller{

    public function checkDir($memid, $ans){
        $root = "/home/vhosts/irb/pdfmerger";
        if(!file_exists($root)){
            mkdir($root);
        }

        if(!file_exists($root."/".substr($memid, 0, 6))){
            mkdir($root."/".substr($memid, 0, 6));
        }
        $root = $root."/".substr($memid, 0, 6);

        if(!file_exists($root."/".substr($memid, 0, 8))){
            mkdir($root."/".substr($memid, 0, 8));
        }
        $root = $root."/".substr($memid, 0, 8);

        if(!file_exists($root."/".$memid)){
            mkdir($root."/".$memid);
        }
        $root = $root."/".$memid;

        if(!file_exists($root."/".$ans)){
            mkdir($root."/".$ans);
        }
        $root = $root."/".$ans;

        return $root;
    }

    public function moveFile($uploadDir, $moveDir){
        $file = glob($uploadDir."/*pdf");
        for($i = 0; $i < count($file); $i++){
            Storage::move(file_get_contents($file[$i]), file_get_contents($moveDir));
        }
        return 0;
    }
}

