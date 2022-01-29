<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmittedHomework;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use Validator;

use App\Models\Teacher;
use App\Models\Homework;
use Illuminate\Support\Facades\DB;

class SubmittedHomeworkController extends Controller
{
    
    public function submittedHomeworkByHomeworkId($id)
    {

         $submittedhomeworkByHomeworkId=Homework::with("submittedHomework")
                                                    ->where("id",$id)
                                                    ->get();

          return response()->json(['status'=>'true','message'=>"submitted homework list according to homework id:",'homework'=>$submittedhomeworkByHomeworkId]);
    }

    public function add(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [ 
            'homework_id' => 'required', 
            'solution_file' => 'required|mimes:pdf', ]);

            if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
             }

            
            $uploaded_file=$request->solution_file->store('studentsSubmittedHomeworks');

          

            $submittedHomework=new SubmittedHomework;
            $userId= $request->user()->id;
            $student = Student::where('user_id',$userId)->first();
            $studentId=$student->id;
            $homeworkId=$request->homework_id;
            $_submittedHomework=SubmittedHomework::where('student_id',$studentId)
                                                ->where('homework_id',$homeworkId)->first();;
            if($_submittedHomework)
                return response()->json (['status'=>'false','message'=>"You already have submitted this homework"]);
            else
            {
                $submittedHomework->homework_id=$homeworkId;
                $submittedHomework->student_id=$studentId;
                $submittedHomework->solution_file=$request->solution_file->hashName();
                $submittedHomework->is_marked=false;
                $result= $submittedHomework->save();

            if($result)
                return response()->json (['status'=>'true','message'=>"Homework is submitted successfully"]);
            else 
               return response()->json (['status'=>'false','message'=>"Homework submission failed"]);


            }
        }

        catch(\Exception $ex) 
                {
                 return response()->json(['status'=>'false','message'=>$ex->getMessage()],500);
                }
        


    }

    public function edit (Request $request)
    {
       $validator = Validator::make($request->all(), [ 
            'mark' => 'required|integer|between:0,100', ]
            );

            if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
             }
      
       $submittedHomework= SubmittedHomework::find($request->id);
       if($submittedHomework->is_marked==true)
        return response()->json (['status'=>'false','message'=>"this homework already has mark"]);

       $submittedHomework->mark=$request->mark;
       $submittedHomework->is_marked=true;
       $result=$submittedHomework->save();
       if($result)
        return response()->json (['status'=>'true','message'=>"mark has been added successfully"]);
    else 
        return response()->json (['status'=>'false','message'=>"failed to add mark for this homework"]);
        
        


    }
    

}
