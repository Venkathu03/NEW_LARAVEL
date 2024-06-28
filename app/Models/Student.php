<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    
    protected $guarded = [''];


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function institution(){
        return $this->hasOne(InstitutionMaster::class,'id','institution_id');
    }
    
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
