<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExampleFileManageController extends Controller
{
    public function upload(Request $request)
    {

        // $request->validate([
        //     // max:kilobytes
        //     // 'file' => 'required|mimes:pdf|max:2048',
        //     'file.*' => 'mimes:pdf|max:20480',
        // ]);

        // $description = $request->get('description'); // assign array of descriptions
        // $fieldName = $request->get('fieldName');
        $file = $request->file('file');
        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $clientid = request()->get('clientid');
            $caseType = request()->get('caseType');

            $path = $clientid.'/example/'.$caseType;

            $fileID = Storage::disk('filepool')->putFileAs($path, $file, $fileName);
        }
        else {
            // handle error here
            return Response()->json([
                'upload' => false
            ]);
        }

        return Response()->json([
            "fileID" => $fileID
        ]);
    }

    /**
     * Delete a example file by clientid, case type and filename.
     * file path: {clientid}/example/{case type}/{filename}
     */
    public function delete()
    {
        $clientid = request()->get('clientid');
        $caseType = request()->get('caseType');

        $path = $clientid.'/example/'.$caseType;
        $filename = basename(request()->get('file')); // basename

        $fileID = $path.'/'.$filename;

        $ret = Storage::disk('filepool')->delete($fileID);
        return Response()->json([
            "Success" => $ret
        ]);
    }

    /**
     * Download a example file by case type and filename.
     * file path: {clientid}/example/{case type}/{filename}
     */
    public function download()
    {
        $clientid = request()->get('clientid');
        $caseType = request()->get('caseType');

        $path = $clientid.'/example/'.$caseType;
        $filename = basename(request()->get('file')); // basename

        $fileID = $path.'/'.$filename;

        // download file
        if(Storage::disk('filepool')->exists($fileID))
        {
            return Storage::disk('filepool')->download($fileID);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        return view('notFound', ['var' => $filename]);
    }

}
