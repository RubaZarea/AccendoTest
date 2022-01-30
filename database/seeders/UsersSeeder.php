<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       for ($i = 0; $i <= 16; $i++) {
            $_password="pass".$i;
            $password=bcrypt($_password); 
            $name="user".$i;
            $email="user".$i."@gmail.com";
            DB::table('users')->insert([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password

        ]);
        }

        
    }
}
