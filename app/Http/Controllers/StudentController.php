<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classroom;

class StudentController extends Controller
{
    public function layDanhSachSV()
    {
        $dsSV = Student::where('accounttype','2')->get();

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
        if($sv == null)
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

    public function showStudent(){
        $classlst=Classroom::all();
        if($classlst==null)
        {
         return 0;
        }
        $SinhVien=Account::all();
        if($SinhVien==null)
        {
          return 0;
        }
        return View('HomePage',compact('classlst'));
      }
      
      public function joinClass(Request $req)
      {
        $listClass=Classroom::all();
        foreach($listClass as $var)
        {
          if($req->malop!=$var->malop)
          {
            return "Lớp không tồn tại";
          }
        }
        
        return redirect()->route('joinClass');
      }
      public function showSingleClass(Request $req){
        $class=Classroom::where('name','=',$req->id)->get();
        return View('Student',compact('class'));
      }
}
