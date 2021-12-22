<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AccountController extends Controller
{
    public function loadAccount(){
        $username= Cookie::get('username');
        $password= Cookie::get('password');
        $account= Account::where('username',$username)->first();
        return View('Account',compact('account'));
    }

    public function dsLopJoined ()
    {
    
    }
}
