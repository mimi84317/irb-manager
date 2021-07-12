<?php

use App\Http\Controllers\ExampleFileManageController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::any('fileDownload', 'FileUploadController@fileDownload')->name('file.download.post');

Route::middleware(['ipcheck'])->group(function() {
    Route::post('register', 'RegisterController@register');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login/{case}/{ansid}/{owner?}', 'AuthController@login');
    //agentflow irb login case:案件類型, ansid:agentflow ansid, owner:owner memid

    /*Route::post('fileUpload', 'FileUploadController@fileUploadPost')->name('file.upload.post');
    Route::post('fileDelete', 'FileUploadController@fileDelete')->name('file.delete.post');
    Route::post('dirDelete', 'FileUploadController@deleteDirectory')->name('dir.delete');*/
    Route::post('logout', 'AuthController@logout')->name('jwt.logout');
    Route::post('refresh', 'AuthController@refresh')->name('jwt.refresh');
    // Route::post('fileupload', 'AuthController@me');

    Route::post('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlist.post');
    Route::post('committee', 'ShowController@showCommittee')->name('committee.post');
    //Route::post('fileuploadlist/setting/{caseType}', 'ShowController@showFileuploadlistSetting')->name('fileuploadlist.setting.post');
    //Route::post('fileuploadlist', 'UpdateController@updateFileuploadlistSetting')->name('fileuploadlist.update');


    // Route::get('fileupload', 'AuthController@me');
});

Route::post('example/upload', 'ExampleFileManageController@upload');//->middleware('auth:api');
Route::post('example/delete', 'ExampleFileManageController@delete');//->middleware('auth:api');
Route::get('example/download', 'ExampleFileManageController@download');//->middleware('auth:api');

