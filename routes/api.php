<?php


use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\StatesController;
use App\Http\Controllers\API\v1\UserController;
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
        Route::get('/lgas', [StatesController::class, 'lgas']);
    });
});