<?php

use App\Http\Controllers\CompanyController;
use App\Http\Middleware\JwtAuth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
        'middleware' => [ 
            JwtAuth::class,
        ],
        'prefix' => 'v1'
    ], function ( $router ) {

    Route::get('test', function () {
        return response(['success' => true, 'message' => 'pong']);
    });

    Route::get( 'company', [ CompanyController::class , 'index' ] );


});