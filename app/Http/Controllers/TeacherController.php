<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Http\Requests\SubmitRequest;

class TeacherController extends Controller
{
    public function layDanhSachGV()
    {
        $dsGV = Account::where([['accounttype','=','2'],['deleted_at','=',null]])->get();

        return view('admin/TeachersList',compact('dsGV'));   
    }
    public function themGV()
    {
        return view('admin/AddTeacher');
    }
    public function xlThemGV(SubmitRequest $rq)
    {
        $gv = new Account;
        $gv->username = $rq->username;
        $gv->password = $rq->password;
        $gv->hoten = $rq->hoten;
        $gv->ngaysinh = $rq->ngaysinh;
        $gv->diachi = $rq->diachi;
        $gv->sdt = $rq->sdt;
        $gv->email = $rq->email;
        $gv->accounttype = 2;
        $gv->created_at = date("Y-m-d");
        $gv->save();
        return redirect()->route('TeachersList');
    }
    public function suaGV($id)
    {
        $dsGV = Account::find($id);
        if($dsGV == null||$dsGV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        return view('admin/UpdateTeacher',compact('dsGV'));
    }
    public function xlSuaGV(SubmitRequest $rq,$id)
    {
        $gv = Account::find($id);
        $gv->username = $rq->username;
        $gv->password = $rq->password;
        $gv->hoten = $rq->hoten;
        $gv->ngaysinh = $rq->ngaysinh;
        $gv->diachi = $rq->diachi;
        $gv->sdt = $rq->sdt;
        $gv->email = $rq->email;
        $gv->accounttype = 2;
        $gv->updated_at = date("Y-m-d");
        $gv->save();
        return redirect()->route('TeachersList');
    }
    public function xoaGV($id)
    {
        $dsGV = Account::find($id);
        if($dsGV == null||$dsGV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        $dsGV->deleted_at = date("Y-m-d");
        $dsGV->save();
        return redirect()->route('TeachersList');
    }
}
