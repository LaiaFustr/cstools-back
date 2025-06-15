<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\DemurrageStorageController;
use App\Http\Controllers\Api\V1\LocalPortController;
use App\Http\Controllers\Api\V1\PostalcodeController;
use App\Http\Controllers\Api\V1\DistanceController;

use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Middleware\AdminMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
 */

//PUBLIC ROUTRES
Route::post('/v1/register', [UserController::class, 'register']);
Route::post('/v1/login', [UserController::class, 'login']);


//PRIVATE ROUTES
Route::middleware([UserAuthMiddleware::class])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });

    Route::apiResource('v1/countries', CountryController::class);
    Route::apiResource('v1/ports', LocalPortController::class);
    //Route::apiResource('demurragestorage', [DemurrageStorageController::class]);

    Route::get('/v1/indexCarrier', [DemurrageStorageController::class, 'indexCarrier']);
    Route::get('/v1/indexPort', [DemurrageStorageController::class, 'indexPorts']);
    Route::get('/v1/portswherecarrier/{carrier}', [DemurrageStorageController::class, 'portsWhereCarrier']);
    Route::get('/v1/carrierswhereport/{port}', [DemurrageStorageController::class, 'carriersWherePort']);
    Route::post('/v1/calculo', [DemurrageStorageController::class, 'calcRes']);

    Route::get('v1/pcbycountry', [PostalcodeController::class, 'index']);

    Route::post('v1/distance', [DistanceController::class, 'show']);
});

Route::middleware([AdminMiddleware::class])->group(function () {});


/* Route::apiResource('v1/countries', CountryController::class);

Route::apiResource('v1/ports', LocalPortController::class);
//Route::apiResource('demurragestorage', [DemurrageStorageController::class]);

Route::get('/v1/indexCarrier', [DemurrageStorageController::class, 'indexCarrier']);
Route::get('/v1/indexPort', [DemurrageStorageController::class, 'indexPorts']);
Route::get('/v1/portswherecarrier/{carrier}', [DemurrageStorageController::class, 'portsWhereCarrier']);
Route::get('/v1/carrierswhereport/{port}', [DemurrageStorageController::class, 'carriersWherePort']);
Route::post('/v1/calculo', [DemurrageStorageController::class, 'calcRes']);

Route::get('v1/pcbycountry', [PostalcodeController::class, 'index']);

Route::post('v1/distance', [DistanceController::class, 'show']); */
