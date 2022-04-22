<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\CheckDir;
use SebastianBergmann\Environment\Console;
use App\Login_log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

use App\Product;


class fileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    use CheckDir;

    public function fileDownload($case, $passID, $file)
    {
        // append file path to filename
        //最新版文件、收件證明
        if($case == "merge" || $case == "proof_of_acceptance"){
            //$file = $memID."_".$insID."_merge.pdf";
            $clientid = auth()->payload()->get('clientid');
            $cut = explode("+", $passID);
            $memID = $cut[0];
            $insID = $cut[1];
            $path = $this->checkDir($clientid, $memID, $insID);
            //$path = $filePath.'/'.$path;
            $path = $path.'/'.$case.'/'.$file;
        }

        //相關文件和備註-檔案上傳
        else{
            $path = auth()->payload()->get('clientid').'/'.$case.'/'.$passID.'/'.$file;
        }

        // download file
        if(Storage::disk('filepool')->exists($path))
        {
            return Storage::disk('filepool')->download($path);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        //return $path;
        return view('notFound', ['var' => $path]);
    }
}
