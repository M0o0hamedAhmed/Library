<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/authors', [ApiAuthController::class, 'index']);             //  http://127.0.0.1:8000/api/authors
Route::get('/authors/show/{id}', [ApiAuthController::class, 'show']);   // http://127.0.0.1:8000/api/authors/show/62


Route::middleware('ApiUserAuth')->group(function () {
    Route::post('/authors/store', [ApiAuthController::class, 'store']);    //  http://127.0.0.1:8000/api/authors/create
    Route::post('/authors/update/{id}', [ApiAuthController::class, 'update']);    //  http://127.0.0.1:8000/api/authors/update
    Route::get('/authors/delete/{id}', [ApiAuthController::class, 'delete']);    //  http://127.0.0.1:8000/api/authors/delete

});
