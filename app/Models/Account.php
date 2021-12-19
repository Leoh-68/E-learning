<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;
    protected $table = 'Account';
    public function AccountType()
    {
        return $this->belongsTo('App\Models\AccountType','accounttype','id');
    }
}
