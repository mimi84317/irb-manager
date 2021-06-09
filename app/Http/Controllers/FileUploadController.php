<?php

namespace App\Http\Controllers;

use App\Traits\CheckDir;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class FileUploadController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CheckDir;

    public function fileUploadPost(Request $request)
    {

        $request->validate([
            // max:kilobytes
            // 'file' => 'required|mimes:pdf|max:2048',
            'file.*' => 'mimes:pdf|max:20480',
        ]);

        // $count = $request->get('fileAndDescriptionCount');
        $description = $request->get('description'); // assign array of descriptions
        $fieldNames = $request->get('fieldName');
        $files = $request->file('file');

        $clientid = auth()->payload()->get('clientid');
        $owner = auth()->payload()->get('owner');
        $ansid = auth()->payload()->get('ansid');

        $memid = $request->get('memid');
        foreach($files as $key => $val)
        {
            $file = $files[$key];
            if ($file->isValid()) {
                // $fileName = time().'.'.$request->file->extension();
                $fileName = $file->getClientOriginalName();
                // $path = $request->get('memid')."/".$request->get('ansid');
                $path = $this->checkDir($clientid, $owner, $ansid);

                // $file->move(public_path('uploads'), $fileName);// move file to our uploads path
                $fileID = Storage::disk('filepool')->putFileAs($path, $file, $fileName);
                // $fileID = Storage::disk('filepool')->putFile($path, $file);

                // write data to BPM API DB
                $bpmapi = env('BPMAPI_URL','http://10.109.51.120').'/BPMAPI/index.php';
                $response = Http::asForm()->withHeaders([
                    'Accept' => 'application/json'
                ])->post($bpmapi, [
                    'funName' => 'callDBApi',
                    'Data' => '{"DB":"BPM","TbName":"IRB_filepool","condition":"","statements":"insert"}',
                    'insertObj' => '{"file_id":"'.$fileID.'",'.
                                    '"ansid":"'.$ansid.'",'.
                                    '"irb_number":"",'.
                                    '"file_name":"'.$fileName.'",'.
                                    '"path":"'.$path.'",'.
                                    '"updated_time":"'.time().'",'.
                                    '"uploader":"'.$memid.'",'.
                                    '"description":"'.$description[$key].'",'.
                                    '"field_name":"'.$fieldNames[$key].'"'.
                                    '}'
                ]);

                if($response=='Insert Failed')
                {
                    return Response()->json([
                        'success' => false
                    ]);
                }
            }
            else {
                // handle error here
                // return back()
                //     ->with('fail','There were some problems.');
                return Response()->json([
                    'success' => false
                ]);
            }
        }
        // return back()
        //             ->with('success','You have successfully upload file.')
        //             ->with('file',$fileName)
        return Response()->json([
            "success" => true
        ]);
    }

    /**
     * Delete a file and db record.
     *
     */
    public function fileDelete(Request $request)
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        // $fileID = $request->input('fileID');
        $clientid = auth()->payload()->get('clientid');
        $owner = auth()->payload()->get('owner');
        $ansid = auth()->payload()->get('ansid');
        $path = $this->checkDir($clientid, $owner, $ansid);

        $filename = $request->input('filename');
        $fileID = $path.'/'.$filename;

        // delete db record
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json'
        ])->post($bpmapi, [
            'funName' => 'callDBApi',
            'Data' => '{"DB":"BPM","TbName":"IRB_filepool","condition":"where file_id = ? ","statements":"delete"}',
            'conArr' => '{"0":"'.$fileID.'"}',
            'column' => ''
        ]);

        // delete file
        if(!Storage::disk('filepool')->exists($fileID))
        {
            return Response()->json([
                "disk" => 'File not exists ',
                "DB" => $response->Body()
            ]);
        }
        $ret = Storage::disk('filepool')->delete($fileID);

        $isDiskDelete = $ret ? 'Success' : 'Fail';

        return Response()->json([
            "disk" => 'Delete '.$isDiskDelete,
            "DB" => $response->Body()
        ]);
    }

    /**
     * Delete a directory and db record.
     *
     */
    public function deleteDirectory()
    {
        $bpmapi = env('BPMAPI_URL').'/BPMAPI/index.php';
        // $fileID = $request->input('fileID');
        $clientid = auth()->payload()->get('clientid');
        $owner = auth()->payload()->get('owner');
        $ansid = auth()->payload()->get('ansid');
        $path = $this->checkDir($clientid, $owner, $ansid);

        // delete db records
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json'
        ])->post($bpmapi, [
            'funName' => 'callDBApi',
            'Data' => '{"DB":"BPM","TbName":"IRB_filepool","condition":"where ansid = ? ","statements":"delete"}',
            'conArr' => '{"0":"'.$ansid.'"}',
            'column' => ''
        ]);

        // delete file
        $ret = Storage::disk('filepool')->deleteDirectory($path);

        $isDiskDelete = $ret ? 'Success' : 'Fail';

        return Response()->json([
            "disk" => 'Delete '.$isDiskDelete,
            "DB" => $response->Body()
        ]);
    }

    /**
     * Download a file by file ID.
     *
     */
    // public function fileDownload(Request $request)
    // {
    //     // download file
    //     if(Storage::disk('filepool')->exists($request->input('fileID')))
    //     {
    //         $headers = ['Content-Type' => 'application/pdf'];
    //         // $file = Storage::disk('filepool')->get($request->input('fileID'));
    //         return Storage::disk('filepool')->download($request->input('fileID'), 'test.pdf', $headers);
    //     }

    //     return Response()->json([
    //         "success" => false
    //     ]);
    // }

    /**
     * Download a file by filename.
     *
     */
    public function fileDownloadPage($path)
    {
        // $path is file name
        $ansid = auth()->payload()->get('ansid');
        $owner = auth()->payload()->get('owner');
        $clientid = auth()->payload()->get('clientid');
        $filePath = $this->checkDir($clientid, $owner, $ansid);

        // append file path to filename
        $path = $filePath.'/'.$path;

        // download file
        if(Storage::disk('filepool')->exists($path))
        {
            return Storage::disk('filepool')->download($path);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        return view('notFound', ['var' => basename($path)]);
    }

    /**
     * Download a example file by case type and filename.
     * path: {clientid}/example/{case type}/{filename}
     */
    public function fileDownloadExample($case, $filename)
    {
        // append file path to filename
        $path = auth()->payload()->get('clientid').'/'.'example/'.$case.'/'.$filename;

        // download file
        if(Storage::disk('filepool')->exists($path))
        {
            return Storage::disk('filepool')->download($path);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        return view('notFound', ['var' => $path]);
    }

    // public function filePreview($path)
    // {
        // $response = Http::timeout(3)->asForm()->withHeaders([
        //     'Authorization' => 'Bearer '. request('token')
        // ])->post(route('file.preview.page', $path),[
        //     'token' => request('token')
        // ]);

        // return redirect()->route('file.preview.page',$path)
        // ->header('Authorization', 'Bearer '. request('token'));
    //     $token = request('token');
    //     return view('filePreview')->with('token',$token)->with('path', $path);
    // }
    public function filePreviewPage($path)
    {
        // $path is file name
        $ansid = auth()->payload()->get('ansid');
        $owner = auth()->payload()->get('owner');
        $clientid = auth()->payload()->get('clientid');
        $filePath = $this->checkDir($clientid, $owner, $ansid);

        // append file path to filename
        $path = $filePath.'/'.$path;

        // download file
        if(Storage::disk('filepool')->exists($path))
        {
            // return Storage::disk('filepool')->download($path);
            $headers = ['Content-Type' => 'application/pdf'];
            $pdf = Storage::disk('filepool')->get($path, basename($path), $headers);
            return Response::make($pdf, 200, $headers);
        }

        // return Response()->json([
        //     "success" => false
        // ]);
        return view('notFound', ['var' => basename($path)]);
    }
    // public function fileList(Request $request)
    // {
    //     $path = $request->get('path');
    //     $ansid = auth()->payload()->get('ansid');

    //     $bpmapi = env('BPMAPI_URL','http://10.109.51.120').'/BPMAPI/index.php';

    //     //upload filelist left join filepool
    //     $response = Http::asForm()->withHeaders([
    //         'Accept' => 'application/json'
    //     ])->post($bpmapi, [
    //         'funName' => 'callDBApi',
    //         'Data' => '{"DB":"BPM","TbName":"IRB_new_case_upload_filelist","condition":" LEFT JOIN (SELECT * FROM IRB_filepool WHERE ansid = \''.$ansid.'\') AS Temp ON IRB_new_case_upload_filelist.chname = Temp.field_name ORDER BY sort ","statements":"select"}',
    //         'conArr' => '{}',
    //         'column' => ''
    //     ]);

    //     $db_files = json_decode($response->Body(), true);
    //     $disk_files = Storage::disk('filepool')->allFiles($path);
    //     $result_array = $disk_files;

    //     foreach($db_files as $file)
    //     {
    //         if(in_array( $file['file_id'], $disk_files))
    //         {
    //             $result_array = array_diff( $result_array, [$file['file_id']] );
    //         }
    //     }
    //     return $result_array;
    // }
}
