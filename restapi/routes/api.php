<?php

use App\Http\Controllers\InverterController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use Illuminate\Http\JsonResponse;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list', [UserController::class, 'list']);
Route::get('/inverters', [InverterController::class, 'list']);
Route::get('/panels', [PanelController::class, 'list']);
