<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MacAddressMaster extends Model
{
    use HasFactory;
    
    
    public function institution(){
        return $this->hasOne(InstitutionMaster::class,'id','institution_id');
    }
}
