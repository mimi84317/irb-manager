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
    //return view('welcome');
    return view('LoginPage');
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

//Route::get('fileDownload/{fileid?}', 'FileUploadController@fileDownloadPage')->name('file.download')->where('fileid', '(.*)');
//Route::get('example/{case}/{fileid?}', 'FileUploadController@fileDownloadExample')->name('example.download')->where('fileid', '(.*)');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    //設定案件上傳清單
    Route::get('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlist');
    Route::post('fileuploadlist', 'ShowController@showFileuploadlist')->name('fileuploadlist.post');

    Route::get('fileuploadlist/setting/{caseType}', 'ShowController@showFileuploadlistSetting')->name('fileuploadlist.setting');
    Route::post('fileuploadlist/setting/{caseType}', 'ShowController@showFileuploadlistSetting')->name('fileuploadlist.setting.post');

    Route::post('fileuploadlist', 'UpdateController@updateFileuploadlistSetting')->name('fileuploadlist.update');

    //設定委員會議程
    Route::get('committee', 'ShowController@showCommittee')->name('committee');
    Route::post('committee', 'ShowController@showCommittee')->name('committee.post');
    //Route::post('committee', 'ShowController@showCommittee')->name('committee.search');

    Route::get('committee/committeeNew', 'ShowController@showCommitteeNew')->name('committeeNew');
    Route::post('committee/committeeNew', 'ShowController@showCommitteeNew')->name('committeeNew.post');

    Route::post('committee', 'UpdateController@updateCommittee')->name('committee.update');
    //Route::post('committee', 'ShowController@showCommittee')->name('committeeNew.search');

});

