<?php

use Illuminate\Support\Facades\Route;

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


// Route::get('/file-upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('/file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');
Route::get('/auth/fileupload', 'AuthController@me')->middleware('api');
Route::post('/auth/fileupload', 'AuthController@me')->middleware('api');
Route::get('expired', 'RegisterController@invalid')->name('login'); // except跳轉位置

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {
//     Route::post('fileupload', 'AuthController@me');
//     Route::get('fileupload', 'AuthController@me');
// });
