<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
   public function save(Request $request)
    {
        $student = new Student;
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->grade=$request->grade;
        $student->phone=$request->phone;
        $student->address=$request->address;
        $student->birth_date=$request->birth_date;


        return Student::all();

    }

}
