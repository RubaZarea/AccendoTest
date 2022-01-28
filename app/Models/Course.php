<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Kirschbaum\PowerJoins\PowerJoins;

class Course extends Model
{
    use HasFactory ;//PowerJoins;
    
    public function homework()
    {
        return $this->hasMany(Homework::class);

    }
}
