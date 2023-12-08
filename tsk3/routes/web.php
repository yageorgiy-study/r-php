<?php

use App\Http\Controllers\WebController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WebController::class . "@welcome");
Route::get('/login', WebController::class . "@auth");

Route::group([
    'middleware' => AdminMiddleware::class,
    'prefix' => 'admin'
], function() {
    Route::get('logs', WebController::class . "@logs");
    Route::get('phpinfo', WebController::class . "@phpinfo");
    Route::get('users', WebController::class . "@users");
});
