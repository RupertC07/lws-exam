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
    Route::prefix('/v1/user')->group(function () {
        Route::post('/', [UserController::class, 'store']);//route for user registration
        Route::post('/auth', [UserController::class, 'auth']); //route for user authentication
        // the following routes are what we called protected routes, since we required token to access it
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/', [UserController::class,'show']);//route to get the profile
            Route::delete('/', [UserController::class,'delete']);//route for user deletion
           Route::post('/signout', [UserController::class,'signout']);//route for signout
        });
    });

    Route::prefix('/v1/anime')->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {

            Route::get('/',[AnimeController::class,'index']);//route to fetch all the anime available
            Route::post('/', [AnimeController::class,'store']);//route to store new Anime
            Route::get('/{id}',[AnimeController::class,'show']);//route to show a single anime
            Route::put('/{id}', [AnimeController::class,'update']);//route to update existing anime
            Route::delete('/{id}', [AnimeController::class,'delete']);//route to delete/remove existing anime
           

             
        });
     
    });

    // Route::post('/test', function (Request $request){
    //     return  $request->all();
    
    // });

    







