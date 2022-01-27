<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\HomeworkController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post("register",[UserController::class,'register']);

Route::post("login", [UserController::class,'login']);

//Route::delete("delete-homework/{id}",[HomeworkController::class,'delete']);


Route::group(['middleware' => 'auth:api'], function(){
  //Route::post("details", [UserController::class,'details']);

   Route::group(['middleware' => 'TeacherPages'], function(){
    Route::delete("homework/delete/{id}",[HomeworkController::class,'delete']);
    Route::post("homework/add",[HomeworkController::class,'add']);
});
});


