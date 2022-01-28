<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Homework extends Model
{
    use HasFactory;
    public function submittedHomework()
    {
        return $this->hasMany(SubmittedHomework::class);
    }
}
