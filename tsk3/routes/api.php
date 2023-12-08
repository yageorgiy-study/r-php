<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/getRandomPassword', ApiController::class . "@getRandomNumber")
    ->name("api.getRandomPassword");

Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('login',    AuthController::class . '@login')
        ->name("api.auth.login");
    Route::post('logout',   AuthController::class . '@logout');
    Route::post('refresh',  AuthController::class . '@refresh');
    Route::post('me',       AuthController::class . '@me');
});
