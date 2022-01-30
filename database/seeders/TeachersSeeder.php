<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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

            
            DB::table('teachers')->insert([
            'first_name'=>$firstName,
            'last_name'=>$lastName,
            'Specialization'=>$Specialization,
            'user_id'=>$userId

        ]);
        }
    }
}
