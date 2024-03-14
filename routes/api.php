<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    //we used prefix so we can organize all of our apis
    Route::prefix('/user')->group(function () {
        Route::post('/', [UserController::class, 'store']); 
        Route::post('/auth', [UserController::class, 'auth']); 
        // the following routes are what we called protected routes, since we required token to access it
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/', [UserController::class,'show']);
            Route::delete('/', [UserController::class,'delete']);
           Route::post('/signout', [UserController::class,'signout']);
        });
    });

    Route::prefix('/anime')->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {

            Route::get('/',[AnimeController::class,'index']);
            Route::post('/', [AnimeController::class,'store']);
            Route::get('/{id}',[AnimeController::class,'show']);
            Route::put('/{id}', [AnimeController::class,'update']);
           

             
        });
     
    });

    Route::post('/test', function (Request $request){
        return  $request->all();
    
    });

    







