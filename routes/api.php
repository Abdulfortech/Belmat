<?php


use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\ElectionController;
use App\Http\Controllers\API\v1\PartiesController;
use App\Http\Controllers\API\v1\PollingUnitsController;
use App\Http\Controllers\API\v1\StatesController;
use App\Http\Controllers\API\v1\SuggestionController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\WardsController;
use App\Http\Controllers\API\v1\ZonesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function ()
{
    Route::group(['prefix' => 'auth'], function () 
    {
        Route::post('/signin', [AuthController::class, 'signin']);
        Route::post('/signup', [AuthController::class, 'signup']);
        Route::post('/forget', [AuthController::class, 'forget']);
        Route::post('/reset', [AuthController::class, 'reset']);
    });

    Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () 
    {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/update', [UserController::class, 'updateProfile']);
        Route::get('/isverified', [UserController::class, 'isVerified']);
        Route::post('/password', [UserController::class, 'updatePassword']);
        Route::post('/pin', [UserController::class, 'setPin']);
        Route::post('/pin/update', [UserController::class, 'updatePin']);
        Route::get('/banks', [UserController::class, 'getBanks']);
        Route::post('/verify/bvn', [UserController::class, 'verifyBVN']);
    });

    Route::group(['prefix' => 'states-lgas'], function () 
    {
        Route::get('/states', [StatesController::class, 'index']);
        Route::get('/states/{id}', [StatesController::class, 'state']);
        Route::get('/states/lgas/{id}', [StatesController::class, 'stateLgas']);
        Route::get('/states/lgas/search/{title}', [StatesController::class, 'stateLgasByTitle']);
        Route::get('/lgas', [StatesController::class, 'lgas']);
        Route::get('/lga/{id}', [StatesController::class, 'lga']);
        Route::get('/lgas/by-title/{title}', [StatesController::class, 'lgaByTitle']);
    });

    Route::group(['prefix' => 'parties'], function () 
    {
        Route::get('/', [PartiesController::class, 'index']);
        Route::get('/{id}', [PartiesController::class, 'view']);
        Route::post('/add', [PartiesController::class, 'add']);
        Route::put('/edit/{id}', [PartiesController::class, 'edit']);
        Route::get('/activate/{id}', [PartiesController::class, 'activate']);
        Route::get('/deactivate/{id}', [PartiesController::class, 'deactivate']);
        Route::delete('/delete/{id}', [PartiesController::class, 'delete']);
    });

    Route::group(['prefix' => 'wards'], function () 
    {
        Route::get('/', [WardsController::class, 'index']);
        Route::get('/{id}', [WardsController::class, 'view']);
        Route::get('/lga/{lga}', [WardsController::class, 'byLga']);
        Route::get('/state/{state}', [WardsController::class, 'byState']);
        Route::post('/add', [WardsController::class, 'add']);
        Route::put('/edit/{id}', [WardsController::class, 'edit']);
        Route::get('/activate/{id}', [WardsController::class, 'activate']);
        Route::get('/deactivate/{id}', [WardsController::class, 'deactivate']);
        Route::delete('/delete/{id}', [WardsController::class, 'delete']);
    });

    
    Route::group(['prefix' => 'polling-units'], function () 
    {
        Route::get('/', [PollingUnitsController::class, 'index']);
        Route::get('/{id}', [PollingUnitsController::class, 'view']);
        Route::get('/ward/{ward}', [PollingUnitsController::class, 'byWard']);
        Route::post('/add', [PollingUnitsController::class, 'add']);
        Route::put('/edit/{id}', [PollingUnitsController::class, 'edit']);
        Route::get('/activate/{id}', [PollingUnitsController::class, 'activate']);
        Route::get('/deactivate/{id}', [PollingUnitsController::class, 'deactivate']);
        Route::delete('/delete/{id}', [StatesController::class, 'delete']);
    });

    Route::group(['prefix' => 'elections'], function () 
    {
        Route::get('/', [ElectionController::class, 'index']);
        Route::get('/{id}', [ElectionController::class, 'view']);
        Route::post('/add', [ElectionController::class, 'add']);
        Route::put('/edit/{id}', [ElectionController::class, 'edit']);
        Route::get('/activate/{id}', [ElectionController::class, 'activate']);
        Route::get('/deactivate/{id}', [ElectionController::class, 'deactivate']);
        Route::delete('/delete/{id}', [ElectionController::class, 'delete']);
    });

    Route::group(['prefix' => 'election-types'], function () 
    {
        Route::get('/', [ElectionController::class, 'electionTypes']);
    });

    Route::group(['prefix' => 'senatorial-zones'], function () 
    {
        Route::get('/', [ZonesController::class, 'senatorialZones']);
    });

    Route::group(['prefix' => 'political-zones'], function () 
    {
        Route::get('/', [ZonesController::class, 'politicalZones']);
    });

    Route::group(['prefix' => 'suggestions'], function () 
    {
        Route::get('/', [SuggestionController::class, 'index']);
        Route::get('/{id}', [SuggestionController::class, 'view']);
        Route::post('/add', [SuggestionController::class, 'add']);
        Route::put('/edit/{id}', [SuggestionController::class, 'edit']);
        Route::get('/activate/{id}', [SuggestionController::class, 'activate']);
        Route::get('/deactivate/{id}', [SuggestionController::class, 'deactivate']);
        Route::delete('/delete/{id}', [SuggestionController::class, 'delete']);
    });
});