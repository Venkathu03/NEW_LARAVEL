<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    use HasFactory;

    public function institution(){
        return $this->hasOne(InstitutionMaster::class,"id","institution_name");
    }
}
