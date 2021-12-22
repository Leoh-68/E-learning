<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class TeacherController extends Controller
{
    public function layDanhSachGV()
    {
        $dsGV = Account::where([['accounttype','=','2'],['deleted_at','=',null]])->get();

        return view('TeachersList',compact('dsGV'));   
    }
    public function themGV()
    {
        return view('AddTeacher');
    }
    public function xlThemGV(Request $rq)
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
        if($dsGV == null)
        {
            return "Không tìm thấy giảng viên có ID = {$id}";
        }
        return view('UpdateTeacher',compact('dsGV'));
    }
    public function xlSuaGV(Request $rq,$id)
    {
        $gv = Account::find($id);
        if($gv == null)
        {
            return "Không tìm thấy giảng viên có ID = {$id}";
        }
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
        if($dsGV == null)
        {
            return "không tìm thấy giảng viên có ID = {$id} ";
        }
        $dsGV->deleted_at = date("Y-m-d");
        $dsGV->save();
        return redirect()->route('TeachersList');
    }
}
