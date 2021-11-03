<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait CheckDir
{
    public function checkDir($clientid, $memid, $ans){
        $root = env('CHECK_DIR_ROOT').'/' ;
        $path = ''.$clientid;


        /*if(!file_exists($root.$path)){
            mkdir($root.$path);
        }

        if(!file_exists($root.$path.'/'.substr($memid, 0, 6))){
            mkdir($root.$path.'/'.substr($memid, 0, 6));
        }
        $path .= '/'.substr($memid, 0, 6);

        if(!file_exists($root.$path.'/'.substr($memid, 0, 8))){
            mkdir($root.$path.'/'.substr($memid, 0, 8));
        }
        $path .= '/'.substr($memid, 0, 8);

        if(!file_exists($root.$path.'/'.$memid)){
            mkdir($root.$path.'/'.$memid);
        }
        $path .= '/'.$memid;

        if(!file_exists($root.$path.'/'.$ans)){
            mkdir($root.$path.'/'.$ans);
        }
        $path .= '/'.$ans;

        return $path;*/
        return $root.$path;
    }

    public function getDirAbsolutePath($clientid, $memid, $ans)
    {
        return env('CHECK_DIR_ROOT').'/'.$this->checkDir($clientid, $memid, $ans);
    }

    public function moveFile($uploadDir, $moveDir){
        $file = glob($uploadDir."/*pdf");
        for($i = 0; $i < count($file); $i++){
            Storage::move(file_get_contents($file[$i]), file_get_contents($moveDir));
        }
        return 0;
    }
}
