<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureTrialMark extends Model
{
    use HasFactory;
    
     public function student(){
        return $this->hasOne(Student::class,'id','student_id');
    }
    
    public function procedure(){
         return $this->hasOne(Procedure::class,'id','procedure_id');
    }
    
     public function proceduretype(){
         return $this->hasOne(ProcedureType::class,'id','procedure_type_id');
    }
}
