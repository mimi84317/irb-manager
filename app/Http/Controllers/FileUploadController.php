<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function fileUpload()
    // {
    //     // insert to log
    //     $clientid = auth()->payload()->get('clientid');
    //     $username = auth()->payload()->get('username');
    //     // $this->insertAccessLog($clientid, $username);
    //     return view('newCaseFilelist', ['username'=> $username, 'clientid'=> $clientid] );
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            // max:kilobytes
            // 'file' => 'required|mimes:pdf|max:2048',
            'file.*' => 'mimes:pdf|max:20480',
        ]);

        // $fileName = time().'.'.$request->file->extension();
        // $fileName = $request->file->getClientOriginalName();

        // $request->file->move(public_path('uploads'), $fileName);

        // return back()
        //     ->with('success','You have successfully upload file.')
        //     ->with('file',$fileName);

        // $count = $request->get('fileAndDescriptionCount');
        // $description = $request->get('description'); // assign array of descriptions
        $files = $request->file('file'); // assign array of images
        foreach($files as $key => $val)
        {
            $file = $files[$key];
            if ($file->isValid()) {
                // $fileName = time().'.'.$request->file->extension();
                $fileName = $file->getClientOriginalName();

                $file->move(public_path('uploads'), $fileName);// move file to our uploads path


                // $data->image_location = $fileName;
                // // or you could say $destinationPath . '/' . $fileName
                // $data->save();
            } else {
                // handle error here
                return back()
                    ->with('fail','There were some problems.');
            }
        }
        return back()
                    ->with('success','You have successfully upload file.')
                    ->with('file',$fileName);

    }
}
