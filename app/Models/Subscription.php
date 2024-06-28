<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function institution(){
        return $this->hasOne(InstitutionMaster::class,"id","institution_id");
    }
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
