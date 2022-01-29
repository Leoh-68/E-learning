<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    use SoftDeletes;
    use HasFactory;
    public function dsCommentPost()
    {
     return $this->hasMany('App\Models\Post','idpost','id');
    }
    public function Post()
    {
        return $this->belongsTo('App\Models\Post','idpost','id');
    }
}
