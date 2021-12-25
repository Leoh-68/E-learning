<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Repsponse;
use Carbon\Carbon;

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
    public function updateAccount(Request $request)
    { 
        $request->validate([
            'hoten'=>'required',
            'diachi'=>'required|',
            'ngaysinh'=>'required|',
            'sdt'=>'required|max:10|min:10',
            'email'=>'required|email'
        ],[
            'hoten.required'=>'Vui lòng nhập đầy đủ thông tin',
            'diachi.required'=>'Vui lòng nhập đầy đủ thông tin',
            'ngaysinh.required'=>'Vui lòng nhập đầy đủ thông tin',
            'sdt.required'=>'Vui lòng nhập đầy đủ thông tin',
            'sdt.max'=>'Số điện thoại phải có :max số',
            'sdt.min'=>'Số điện thoại phải có :min số',
            'email.required'=>'Vui lòng nhập đầy đủ thông tin',
        ]);
    $account1=Account::where('username',Cookie::get('username'))->first();
    $account=Account::where('id',$account1->id)->first();
    $account->hoten=$request->hoten;
    $account->ngaysinh=$request->ngaysinh;
    $account->diachi=$request->diachi;
    $account->sdt=$request->sdt;
    $account->email=$request->email;
    $account->save();
    return redirect()->route('loadAccount');    

    }
}
