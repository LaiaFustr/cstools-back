<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\DemurrageStorageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/countries', CountryController::class);
//Route::apiResource('demurragestorage', [DemurrageStorageController::class]);



Route::get('/v1/indexCarrier', [DemurrageStorageController::class, 'indexCarrier']);
Route::get('/v1/indexPort', [DemurrageStorageController::class, 'indexPorts']);
Route::get('/v1/portswherecarrier/{carrier}', [DemurrageStorageController::class, 'portsWhereCarrier']);
Route::get('/v1/carrierswhereport/{port}', [DemurrageStorageController::class, 'carriersWherePort']);
Route::post('/v1/calculo', [DemurrageStorageController::class, 'calcRes']);