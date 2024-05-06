<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CampainController;
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
// Route::get('/test','App\Http\Controllers\TestController@index');

Route::controller(BrandController::class)->group(function () {
    Route::get('/get-all-brands', 'getAllBrands');
    Route::post('/store-brand', 'store');
    Route::get('/get-brand/{id}', 'show');
    Route::post('/update-brand/{id}', 'update');
    Route::post('/delete-brand/{id}', 'destroy');
});

Route::controller(CampainController::class)->group(function () {
    Route::get('/get-all-campains', 'getAllCampains');
    Route::get('/get-ready-campains', 'getReadyCampains');
    Route::get('/get-live-campains', 'getLiveCampains');
    Route::post('/store-campain', 'store');
    Route::get('/get-campain/{id}', 'show');
    Route::post('/update-campain/{id}', 'update');
    Route::post('/delete-campain/{id}', 'destroy');
});

