<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='post';
    public function dsTep()
    {
     return $this->belongsTo('App\Models\Attachment','id','idpost');
    }
    public function dsComment()
    {
     return $this->belongsTo('App\Models\Comment','idpost','id');
    }
}
