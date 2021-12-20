<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function layDanhSachSV()
    {
        $dsSV = Student::where([['accounttype','=','2'],['deleted_at','=',null]])->get();

        return view('StudentsList',compact('dsSV'));   
    }
    public function themSV()
    {
        return view('AddStudent');
    }
    public function xlThemSV(Request $rq)
    {
        $sv = new Student;
        $sv->username = $rq->username;
        $sv->password = $rq->password;
        $sv->hoten = $rq->hoten;
        $sv->ngaysinh = $rq->ngaysinh;
        $sv->diachi = $rq->diachi;
        $sv->sdt = $rq->sdt;
        $sv->email = $rq->email;
        $sv->accounttype = 2;
        $sv->created_at = date("Y-m-d");
        $sv->save();
        return redirect()->route('StudentsList');
    }
    public function suaSV($id)
    {
        $dsSV = Student::find($id);
        if($dsSV == null)
        {
            return "Không tìm thấy sinh viên có ID = {$id}";
        }
        return view('UpdateStudent',compact('dsSV'));
    }
    public function xlSuaSV(Request $rq,$id)
    {
        $sv = Student::find($id);
        if($dsSV == null)
        {
            return "Không tìm thấy sinh viên có ID = {$id}";
        }
        $sv->username = $rq->username;
        $sv->password = $rq->password;
        $sv->hoten = $rq->hoten;
        $sv->ngaysinh = $rq->ngaysinh;
        $sv->diachi = $rq->diachi;
        $sv->sdt = $rq->sdt;
        $sv->email = $rq->email;
        $sv->accounttype = 2;
        $sv->updated_at = date("Y-m-d");
        $sv->save();
        return redirect()->route('StudentsList');
    }
    public function xoaSV($id)
    {
        $dsSV = Student::find($id);
        if($dsSV == null)
        {
            return "không tìm thấy giảng viên có ID = {$id} ";
        }
        $dsSV->deleted_at = date("Y-m-d");
        $dsSV->save();
        return redirect()->route('StudentsList');
    }
}
