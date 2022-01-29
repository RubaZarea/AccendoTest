<?php

namespace App\Http\Controllers\API;

use App\Models\Homework;
use App\Models\Teacher;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class HomeworkController extends Controller
{
    public function homeworkByCourse($id)
    {


         
       $homeworkByCourse=Course::with("homework")->where("id",$id)->get();
       // find($id)->homework;
       return response()->json(['status'=>'true','message'=>"homework list according to course id",'course'=>$homeworkByCourse]);


    }
    public function add(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'end_date' => 'required|date',
            'homework_requirements_file' => 'required|mimes:pdf', ]);

            if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
             }


             //this block is for obtaining course_Id :
            $userId= $request->user()->id;
            $teacher = Teacher::where('user_id',$userId)->first();
            $teacherId=$teacher->id;
            $course=Course::where('teacher_id',$teacherId)->first();
                if ($course)
                    {
                        $courseId=$course->id;
                    }  
                else 
                    return response()->json (['status'=>'false','message'=>"Can't add a new homework because this teacher is not teaching any courses"]);

             


            $uploaded_file=$request->homework_requirements_file->store('apiDocuments');

            $homework=new Homework;
            $homework->title = $request->title;
            $homework->end_date= date('Y-m-d H:i:s' , strtotime($request->end_date));
            $homework->requirement_file=$request->homework_requirements_file->hashName();
            $homework->course_id=$courseId;
            $result= $homework->save();

            if($result)
               return response()->json (['status'=>'true','message'=>"homework added successfully"]);
                
            else 
                return response()->json (['status'=>'false','message'=>"failed to add homework"]);
               
        }
        catch(\Exception $ex) 
        {
         return response()->json(['status'=>'false','message'=>$ex->getMessage()],500);
        }
    }

        public function delete($id)
        {
            try
            {
                $homework= Homework::find($id);
                if ($homework)
                  {
                    $result=$homework->delete();
                    return response()->json (['status'=>'true','message'=>"homework has been deleted "]);
                  }
                else
                    return response()->json (['status'=>'false','message'=>"delete operation has failed, the homework id is wrong"]);
            }

             catch(\Exception $ex) 
        {
         return response()->json(['status'=>'false','message'=>$ex->getMessage()],500);
        }



        }

        public function downloadFile(Request $request)

        {
            $file_name=$request->requirement_file;

            return response()->download(storage_path('app/apiDocuments/'.$file_name),'image');
        }

    }

