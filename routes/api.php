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

    Route::post('logout', 'AuthController@logout')->name('jwt.logout');
    Route::post('refresh', 'AuthController@refresh')->name('jwt.refresh');
    // Route::post('fileupload', 'AuthController@me');

    Route::post('fileuploadlist/{caseType}/upload', 'FileuploadlistController@fileUploadPost')->name('fileuploadlist.upload.post');
    Route::post('projectRemark/upload', 'projectController@fileUploadPost')->name('projectRemark.upload.post');

    Route::post('fileuploadlist/post', 'FileuploadlistController@showFileuploadlist')->name('fileuploadlist.post');
    Route::post('committee', 'CommitteeController@showCommittee')->name('committee.post');
    Route::post('delete', 'CommitteeController@deleteCommittee')->name('committee.delete');
    Route::post('manageFlow', 'manageFlowController@showmanageFlow')->name('manageFlow.post');
    Route::post('manageProtocol', 'manageProtocolController@showmanageProtocol')->name('manageProtocol.post');
    Route::post('projectContent', 'projectController@showprojectContent')->name('projectContent.post');
    Route::post('projectRemark', 'projectController@showprojectRemark')->name('projectRemark.post');
    Route::post('manageNotOngoingProtocol', 'manageNotOngoingProtocolController@showmanageNotOngoingProtocol')->name('manageNotOngoingProtocol.post');
    Route::post('manageProtocolTrackingInfoDetail', 'manageProtocolTrackingInfoDetailController@showmanageProtocolTrackingInfoDetail')->name('manageProtocolTrackingInfoDetail.post');

    // Route::get('fileupload', 'AuthController@me');
});

/*Route::post('example/upload', 'ExampleFileManageController@upload')->name('exampleFile.upload');//->middleware('auth:api');
Route::post('example/delete', 'ExampleFileManageController@delete');//->middleware('auth:api');
Route::get('example/download', 'ExampleFileManageController@download');//->middleware('auth:api');*/

