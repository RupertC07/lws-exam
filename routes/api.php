<?php

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





    Route::prefix('/user')->group(function () {

        Route::post('/', [UserController::class, 'store']); 
        Route::post('/auth', [UserController::class, 'auth']); 

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/', [UserController::class,'show']);
           Route::post('/signout', [UserController::class,'signout']);

        });
    
    });

    Route::post('/test', function (Request $request){
        return  $request->all();
    
    });

    







