<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;
    protected $table = 'accounttype';

    public function danhSachAccount()
    {
        return $this->hasMany('App\Models\Account','accounttype','id');
    }
}
