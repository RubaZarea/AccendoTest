<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
   //
    public function getCourses()
    {
        $courses=Course::all();
        if($courses)
        return response()->json(['status'=>'true','course'=>$courses]);
    else
        return response()->json(['status'=>'true','message'=>"failed to fetch courses"]);

    }
}
