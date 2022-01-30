<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $teachersUserId =DB::table('teachers')->pluck('user_id');
        
        $availableUsersID = DB::table('users')->select('id')->whereNotIn('id', $teachersUserId)->get()->pluck('id');

        for ($i = 0; $i <= 8; $i++) {
            
            $studentsUserId =DB::table('students')->pluck('user_id');
            $userId=$availableUsersID->random();
            while($studentsUserId->contains($userId))
            {
                $userId=$availableUsersID->random();
            }
            $firstName="student".$i;
            $lastName="std";
            $grade=Str::random(10);
            
            DB::table('students')->insert([
            'first_name'=>$firstName,
            'last_name'=>$lastName,
            'grade'=>$grade,
            'user_id'=>$userId

        ]);
        }
    }
}
 

