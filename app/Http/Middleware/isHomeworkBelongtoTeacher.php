<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Homework;
use App\Models\SubmittedHomework;
use Illuminate\Support\Facades\DB;

class isHomeworkBelongtoTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $currentUserId=$request->user()->id;
        $submittedHomeworkId=$request->id;
        $submittedHomework= SubmittedHomework::find($submittedHomeworkId);

       if(!$submittedHomework)
         return response()->json (['status'=>'false','message'=>"the requested id is wrong"]);

    

        $user =DB::table('users')
                ->join('teachers', 'users.id', '=', 'teachers.user_id')
                ->join('courses', 'teachers.id', '=', 'courses.teacher_id')
                ->join('homework', 'courses.id', '=', 'homework.course_id')
                ->join('submitted_homework', 'homework.id', '=', 'submitted_homework.homework_id')
                ->select('users.id','teachers.first_name')
                ->where('users.id', '=', $currentUserId)
                ->where('submitted_homework.id', '=', $submittedHomeworkId)
                ->get();
                   
                    
        if ($user->isEmpty())  
            return response()->json (['status'=>'false','message'=>"sorry ,this homework doesn't belong to you"]);
        

        else
            return $next($request); 

}
}
