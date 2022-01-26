<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;
    protected $table ='account';
   
    public function dsLop()
    {
     return $this->belongsTo('App\Models\Classroom','id','idaccount');
    }

    public function lstClassJoined ()
    {
       return $this->belongsToMany('App\Models\Classroom','studentlist','idaccount','idclassroom','id','id')->withPivot('waitingqueue','stt');
    }
    public function TheoIdAccount()
    {
       return $this->belongsTo('App\Models\StudentList','id','idaccount');
    }
}
