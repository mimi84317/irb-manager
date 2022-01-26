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
//Route::get('fileDownload/{fileid?}', 'FileuploadlistController@fileDownloadPage')->name('file.download')->where('fileid', '(.*)');
Route::get('example/{case}/{fileid?}', 'FileuploadlistController@fileDownloadExample')->name('example.download')->where('fileid', '(.*)');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    //設定案件上傳清單
    Route::get('fileuploadlist', 'FileuploadlistController@showFileuploadlist')->name('fileuploadlist');
    Route::post('fileuploadlist', 'FileuploadlistController@showFileuploadlist')->name('fileuploadlist.post');

    Route::get('fileuploadlist/setting/{caseType}', 'FileuploadlistController@showFileuploadlistSetting')->name('fileuploadlist.setting');
    Route::post('fileuploadlist/setting/{caseType}', 'FileuploadlistController@showFileuploadlistSetting')->name('fileuploadlist.setting.post');

    Route::post('fileuploadlist', 'FileuploadlistController@updateFileuploadlistSetting')->name('fileuploadlist.update');

    Route::post('fileupload', 'AuthController@me')->name('fileupload');
    Route::get('fileupload', 'AuthController@me');

    //設定委員會議程
    Route::get('committee', 'CommitteeController@showCommittee')->name('committee');
    Route::post('committee', 'CommitteeController@showCommittee')->name('committee.post');

    Route::get('committee/committeeList', 'CommitteeController@showCommitteeList')->name('committeeList');
    Route::post('committee/committeeList', 'CommitteeController@showCommitteeList')->name('committeeList.post');

    Route::get('committee/committeeContent', 'CommitteeController@showCommitteeContent')->name('committeeContent');
    Route::post('committee/committeeContent', 'CommitteeController@showCommitteeContent')->name('committeeContent.post');

    Route::post('committee', 'CommitteeController@updateCommittee')->name('committee.update');

    //瀏覽全部審查案
    Route::get('manageFlow', 'manageFlowController@showmanageFlow')->name('manageFlow');
    Route::post('manageFlow', 'manageFlowController@showmanageFlow')->name('manageFlow.post');

    Route::get('manageFlow/manageFlowContent', 'manageFlowController@showmanageFlowContent')->name('manageFlowContent');
    Route::post('manageFlow/manageFlowContent', 'manageFlowController@showmanageFlowContent')->name('manageFlowContent.post');

    //管理全部計畫與追蹤審查預定日
    Route::get('manageProtocol', 'manageProtocolController@showmanageProtocol')->name('manageProtocol');
    Route::post('manageProtocol', 'manageProtocolController@showmanageProtocol')->name('manageProtocol.post');
    Route::post('manageProtocol', 'manageProtocolController@updatetxtField')->name('manageProtocol.update');
    //Route::post('manageProtocol', 'manageProtocolController@updatetxtOtherNo')->name('manageProtocol.txtOtherNo.update');

    //案件列表
    Route::get('projectContent', 'projectContentController@showprojectContent')->name('projectContent');
    Route::post('projectContent', 'projectContentController@showprojectContent')->name('projectContent.post');
});

