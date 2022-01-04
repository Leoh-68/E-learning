<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SubmitRequest;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function layDanhSachAd()
    {
        $dsAD = Account::where([['accounttype','=','1'],['deleted_at','=',null]])->get();
        
        return view('admin/AdminsList',compact('dsAD'));   
    }
    public function themAd()
    {
        return view('admin/AddAdmin');
    }
    public function xlThemAd(SubmitRequest $rq)
    {
        $ad = new Account;
        $ad->username = $rq->username;
        $ad->password = Hash::make($rq->password);
        $ad->hoten = $rq->hoten;
        $ad->ngaysinh = $rq->ngaysinh;
        $ad->diachi = $rq->diachi;
        $ad->sdt = $rq->sdt;
        $ad->email = $rq->email;
        $ad->accounttype = 1;
        $ad->created_at = date("Y-m-d");
        $ad->save();
        return redirect()->route('AdminsList');
    }
    public function suaAd($id)
    {
        $dsAD = Account::find($id);
        if($dsAD == null||$dsAD->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        return view('admin/UpdateAdmin',compact('dsAD'));
    }
    public function xlSuaAd(SubmitRequest $rq,$id)
    {
        $ad = Account::find($id);
        $ad->username = $rq->username;
        $ad->password = Hash::make($rq->password);
        $ad->hoten = $rq->hoten;
        $ad->ngaysinh = $rq->ngaysinh;
        $ad->diachi = $rq->diachi;
        $ad->sdt = $rq->sdt;
        $ad->email = $rq->email;
        $ad->accounttype = 1;
        $ad->updated_at = date("Y-m-d");
        $ad->save();
        return redirect()->route('AdminsList');
    }
    public function xoaAd($id)
    {
        $dsAD = Account::find($id);
        if($dsAD == null||$dsAD->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        $dsAD->deleted_at = date("Y-m-d");
        $dsAD->save();
        return redirect()->route('AdminsList');
    }
}
