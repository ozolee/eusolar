<?php

use App\Http\Controllers\InverterController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------|
*/

Route::get('/inverters', [InverterController::class, 'list']);
Route::get('/panels', [PanelController::class, 'list']);
Route::post('/quote', [InverterController::class, 'quote']);
