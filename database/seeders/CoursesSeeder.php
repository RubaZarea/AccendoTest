<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachersIDs =DB::table('teachers')->pluck('id');

        for ($i = 0; $i <= 8; $i++) {
            
           
            $teacherId=$teachersIDs->random();
            $courseName="course".$i;
            $semester=Str::random(10);
           
            
            DB::table('courses')->insert([
            'teacher_id'=>$teacherId,
            'name'=>$courseName,
            'semester'=>$semester
        ]);
        }
    }
}
