<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Http\Requests\SubmitRequest;

class StudentController extends Controller
{
    public function layDanhSachSV()
    {
        $dsSV = Account::where([['accounttype','=','3'],['deleted_at','=',null]])->get();
        
        return view('admin/StudentsList',compact('dsSV'));   
    }
    public function themSV()
    {
        return view('admin/AddStudent');
    }
    public function xlThemSV(SubmitRequest $rq)
    {
        $sv = new Account;
        $sv->username = $rq->username;
        $sv->password = Hash::make($rq->password);
        $sv->hoten = $rq->hoten;
        $sv->ngaysinh = $rq->ngaysinh;
        $sv->diachi = $rq->diachi;
        $sv->sdt = $rq->sdt;
        $sv->email = $rq->email;
        $sv->accounttype = 3;
        $sv->created_at = date("Y-m-d");
        $sv->save();
        return redirect()->route('StudentsList');
    }
    public function suaSV($id)
    {
        $dsSV = Account::find($id);
        if($dsSV == null||$dsSV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        return view('admin/UpdateStudent',compact('dsSV'));
    }
    public function xlSuaSV(SubmitRequest $rq,$id)
    {
        $sv = Account::find($id);
        $sv->username = $rq->username;
        $sv->password = Hash::make($rq->password);
        $sv->hoten = $rq->hoten;
        $sv->ngaysinh = $rq->ngaysinh;
        $sv->diachi = $rq->diachi;
        $sv->sdt = $rq->sdt;
        $sv->email = $rq->email;
        $sv->accounttype = 3;
        $sv->updated_at = date("Y-m-d");
        $sv->save();
        return redirect()->route('StudentsList');
    }
    public function xoaSV($id)
    {
        $dsSV = Account::find($id);
        if($dsSV == null||$dsSV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        $dsSV->deleted_at = date("Y-m-d");
        $dsSV->save();
        return redirect()->route('StudentsList');
    }
}
