<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\APIController;
use \App\Http\Controllers\TeamsController;
use \App\Http\Controllers\PlayersController;

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

Route::post('/login',[APIController::class,'login']);
Route::get('/teams',[TeamsController::class,'index']);
Route::get('players/{teams}',[PlayersController::class,'index']);

Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/logout',[APIController::class,'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['role'])->group(function (){
        Route::post('team',[TeamsController::class,'store']);
        Route::put('team/{teams}',[TeamsController::class,'update']);
        Route::delete('team/{teams}',[TeamsController::class,'destroy']);

        Route::post('player',[PlayersController::class,'store']);
        Route::put('player/{players}',[PlayersController::class,'update']);
        Route::delete('player/{players}',[PlayersController::class,'destroy']);
    });
});
