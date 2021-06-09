<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::get('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlist');

    Route::get('fileuploadlist/setting/{caseType}', 'ShowController@showFileuploadlistSetting')->name('fileuploadlist.setting');
    Route::post('fileuploadlist', 'UpdateController@updateFileuploadlistSetting')->name('fileuploadlist.update');
});*/

Route::get('expired', 'ViewController@invalid')->name('login'); // except跳轉位置
Route::get('fileDownload/{fileid?}', 'FileUploadController@fileDownloadPage')->name('file.download')->where('fileid', '(.*)');
Route::get('example/{case}/{fileid?}', 'FileUploadController@fileDownloadExample')->name('example.download')->where('fileid', '(.*)');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlistpost');
    Route::get('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlist');

    Route::get('fileuploadlist/setting/{caseType}', 'ShowController@showFileuploadlistSetting')->name('fileuploadlist.setting');
    Route::post('fileuploadlist', 'UpdateController@updateFileuploadlistSetting')->name('fileuploadlist.update');

    // Route::get('filePreview/{fileid?}', 'FileUploadController@filePreview')->name('file.preview')->where('fileid', '(.*)');
    /*Route::post('preview/{filename?}', 'FileUploadController@filePreviewPage')->name('file.preview.page')->where('filename', '(.*)');

    Route::post('merge/{clientid}/{memid}/{ans}', 'PDFMergerController@pdfMerge')->name('pdf.merge')->middleware('auth:api');*/
});

