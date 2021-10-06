<?php

use Illuminate\Http\Request;
use app\Http\Controllers\enquete\EnqueteController;
use app\Http\Controllers\enquete\ListController;

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

if (app()->isLocal()) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
    header('Access-Control-Expose-Headers: X-Pagination');
    header('Access-Control-Allow-Credentials: true');
}

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//phpinfoが見たい時　api/
Route::get('/', 'enquete\\EnqueteController@phpinfo');

//一覧取得
Route::post('/enquete/list','enquete\\ListController@getList');
//詳細取得
Route::get('/enquete/{id}','enquete\\EnqueteController@getDetail');
//入力チェック
Route::post('/enquete/validationCheck','enquete\\EnqueteController@validationCheck');
//新規保存
Route::post('/enquete/save','enquete\\EnqueteController@save');

Route::post('/enquete/update','enquete\\EnqueteController@update');