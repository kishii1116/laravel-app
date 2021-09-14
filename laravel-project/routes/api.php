<?php

use Illuminate\Http\Request;
use app\Http\Controllers\enquete\EnqueteController;

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

Route::get('/', 'enquete\\EnqueteController@phpinfo');

Route::post('/enquete','enquete\\EnqueteController@save');