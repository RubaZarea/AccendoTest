<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\HomeworkController;
use App\Http\Controllers\API\SubmittedHomeworkController;
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






Route::group(['middleware' => 'auth:api'], function(){

Route::get("getSubmittedHomeworkByHomeworkId/{id}", [SubmittedHomeworkController::class,'submittedHomeworkByHomeworkId']);
            Route::delete("deleteHomework/{id}",[HomeworkController::class,'delete']);
    

   //Route::post("details", [UserController::class,'details']);

   Route::get("downloadHomework", [HomeworkController::class,'downloadFile']);
   Route::get("getHomeworkByCourse/{id}", [HomeworkController::class,'homeworkByCourse']);
   Route::post("addSubmittedHomework",[SubmittedHomeworkController::class,'add'])->middleware('studentPage');
   Route::group(['middleware' => 'TeacherPages'], function(){
        
        Route::post("addHomework",[HomeworkController::class,'add']);
        Route::group(['middleware' => 'HomeworkBelongtoTeacher'], function(){
            Route::put("putHomeworkMark/{id}", [SubmittedHomeworkController::class,'edit']);

             });
    });
});


