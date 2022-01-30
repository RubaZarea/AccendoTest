<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class StudentsController extends Controller
{
   public function save(Request $request)
    {
         $studentsUserId =DB::table('students')->pluck('user_id');
        $availableUsersID = DB::table('users')->select('id')->whereNotIn('id', $studentsUserId)->get()->pluck('id');

        for ($i = 0; $i <= 4; $i++) {
            $teachersUserId =DB::table('teachers')->pluck('user_id');
            $userId=$availableUsersID->random();
            //to be sure that user_id is unique on teachers table:
            while($teachersUserId->contains($userId))
            {
                $userId=$availableUsersID->random();
            }
            $firstName="teacher".$i;
            $lastName="tchr";
            $Specialization=Str::random(10);
         }
          return $availableUsersID ; 

    }

}
