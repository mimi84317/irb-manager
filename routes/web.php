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
    return view('loginPage');
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
//Route::get('fileDownload/{fileid?}', 'fileuploadlistController@fileDownloadPage')->name('file.download')->where('fileid', '(.*)');
Route::get('example/{case}/{fileid?}', 'fileuploadlistController@fileDownloadExample')->name('example.download')->where('fileid', '(.*)');
//Route::get('projectRemark/{txtAppNo}/{fileid?}', 'projectController@fileDownloadRemarkFile')->name('remarkFile.download')->where('fileid', '(.*)');
Route::get('fileDownload/{case?}/{passID?}/{fileid?}', 'fileController@fileDownload')->name('file.download')->where('fileid', '(.*)');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    //設定案件上傳清單
    Route::get('fileuploadlist', 'fileuploadlistController@showFileuploadlist')->name('fileuploadlist');
    Route::post('fileuploadlist', 'fileuploadlistController@showFileuploadlist')->name('fileuploadlist.post');

    Route::get('fileuploadlist/setting/{caseType}', 'fileuploadlistController@showFileuploadlistSetting')->name('fileuploadlist.setting');
    Route::post('fileuploadlist/setting/{caseType}', 'fileuploadlistController@showFileuploadlistSetting')->name('fileuploadlist.setting.post');

    Route::post('fileuploadlist', 'fileuploadlistController@updateFileuploadlistSetting')->name('fileuploadlist.update');

    Route::post('fileupload', 'AuthController@me')->name('fileupload');
    Route::get('fileupload', 'AuthController@me');

    //設定委員會議程
    Route::get('committee', 'committeeController@showCommittee')->name('committee');
    Route::post('committee', 'committeeController@showCommittee')->name('committee.post');

    Route::get('committee/committeeList', 'committeeController@showCommitteeList')->name('committeeList');
    Route::post('committee/committeeList', 'committeeController@showCommitteeList')->name('committeeList.post');

    Route::get('committee/committeeContent', 'committeeController@showCommitteeContent')->name('committeeContent');
    Route::post('committee/committeeContent', 'committeeController@showCommitteeContent')->name('committeeContent.post');

    Route::post('committee', 'committeeController@updateCommittee')->name('committee.update');

    //瀏覽全部審查案
    Route::get('manageFlow', 'manageFlowController@showmanageFlow')->name('manageFlow');
    Route::post('manageFlow', 'manageFlowController@showmanageFlow')->name('manageFlow.post');

    Route::get('manageFlow/manageFlowContent', 'manageFlowController@showmanageFlowContent')->name('manageFlowContent');
    Route::post('manageFlow/manageFlowContent', 'manageFlowController@showmanageFlowContent')->name('manageFlowContent.post');

    //管理全部計畫與追蹤審查預定日
    Route::get('manageProtocol', 'manageProtocolController@showmanageProtocol')->name('manageProtocol');
    Route::post('manageProtocol', 'manageProtocolController@showmanageProtocol')->name('manageProtocol.post');
    Route::post('manageProtocol', 'manageProtocolController@updatetxtField')->name('manageProtocol.update');
    Route::get('tracingDateSetting', 'trackingInfoDetailController@showtracingDateSetting')->name('tracingDateSetting');
    Route::post('tracingDateSetting', 'trackingInfoDetailController@showtracingDateSetting')->name('tracingDateSetting.post');
    Route::post('tracingDateSetting', 'trackingInfoDetailController@updatetracingDateSetting')->name('tracingDateSetting.update');

    //案件列表
    Route::get('projectContent', 'projectController@showprojectContent')->name('projectContent');
    Route::post('projectContent', 'projectController@showprojectContent')->name('projectContent.post');

    //案件之相關文件與備註
    Route::get('projectRemark', 'projectController@showprojectRemark')->name('projectRemark');
    Route::post('projectRemark', 'projectController@showprojectRemark')->name('projectRemark.post');
    Route::post('projectRemark', 'projectController@updateprojectRemark')->name('projectRemark.update');

    //管理未正進行的計畫
    Route::get('manageNotOngoingProtocol', 'manageNotOngoingProtocolController@showmanageNotOngoingProtocol')->name('manageNotOngoingProtocol');
    Route::post('manageNotOngoingProtocol', 'manageNotOngoingProtocolController@showmanageNotOngoingProtocol')->name('manageNotOngoingProtocol.post');

    //管理追蹤審查預定日功能
    Route::get('manageProtocolTrackingInfoDetail', 'trackingInfoDetailController@showmanageProtocolTrackingInfoDetail')->name('manageProtocolTrackingInfoDetail');
    Route::post('manageProtocolTrackingInfoDetail', 'trackingInfoDetailController@showmanageProtocolTrackingInfoDetail')->name('manageProtocolTrackingInfoDetail.post');

    //外部案件匯入
    Route::get('projectImport', 'manageNotOngoingProtocolController@showmanageNotOngoingProtocol')->name('projectImport');
    Route::post('projectImport', 'projectImportController@showprojectImport')->name('projectImport.post');
});

