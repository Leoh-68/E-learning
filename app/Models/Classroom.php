<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='classroom';

    public function theoAccount()
    {
       return $this->belongsTo('App\Models\Account','idaccount','id');
    }

    public function dsStudentJoined ()
    {
       return $this->belongsToMany('App\Models\Account','studentlist','idclassroom','idaccount','id','id')->withPivot('waitingqueue','stt');
    }
    public function dsClassJoined ()
    {
       return $this->belongsTo('App\Models\Account','studentlist','idclassroom','idaccount','id','id');
    }
}
