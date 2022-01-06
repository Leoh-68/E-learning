<?php
namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Account;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Repsponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassroomController extends Controller
{
  public function Classroom(){
      return view('Teacher/Class');
  }     
  public function getUpdateClass(Request $req){
    $class=Classroom::where('malop','=',$req->id)->get();
    return View('Teacher/UpdateClass',compact('class'));
  }
/*Lớp của giáo viên*/
  public function showClass(Request $request){
    $account=Account::where('username',$request->session()->get('username'))->first();
    $classlst=Classroom::where('idaccount',$account->id)->get();
    if($classlst==null)
    {
      return 0;
    }
    return View('Teacher/HomePage',compact('classlst'));
  }
/*Lớp của admin*/
  public function layDSLopHoc(){

    $lst=Classroom::all();
    return View('admin/ClassroomsList',compact('lst'));
  }
/*Lớp của sinh viên*/
  public function addClass(Request $req)
  {
    $req->validate([
      'classname'=>'required',
      'classcode'=>'required|max:6|min:6'
    ],[
      'classname.required'=>'Vui lòng nhập đầy đủ tên lớp',
      'classcode.required'=>'Vui lòng nhập đầu đủ mã lớp',
      'classcode.min'=>'Mã lớp phải có :min ký tự',
      'classcode.max'=>'Mã lớp phải có :max ký tự'
    ]);
    $account=Account::where('username', session('username'))->first();
    $listClass=Classroom::all();
    $account=Account::where('username', session('username'))->first();
    $class=new Classroom;
    $class->idaccount=$account->id;
    $class->name=$req->classname;
    $class->malop=$req->classcode;
    $class->save();
    return redirect()->route('showClass');
  }
  public function showSingleClass(Request $req){
    $class=Classroom::where('malop','=',$req->id)->get();

    return View('Teacher/Class',compact('class'));
  }

  public function showSingleClassStudent(Request $req){
    $class=Classroom::where('malop','=',$req->id)->get();

    return View('Student/ClassStudent',compact('class'));
  }

  public function updateClass(Request $req){
    $req->validate([
      'classname'=>'required',
      'username'=>'required',
      'classname.required'=>'Vui lòng nhập đầy đủ tên lớp',
    ]);
    $class=Classroom::where('malop','=',$req->id)->first();
    $class->name=$req->classname;
    $class->save();
   return redirect()->route('showClass');
  }
  public function deleteClass(Request $req)
  {
    $class=Classroom::where('malop','=',$req->id)->first();
    $class->deleted_at= Carbon::now(); 
    $class->save();
   return redirect()->route('showClass');
  }

  public static function randomCode()
  {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $class= Classroom::all();
    $code= substr(str_shuffle(str_repeat($pool, 5)), 0, 6);
    foreach($class as $var)
    {
      while($var->malop==$class)
      {
        $code= rand(6);
      }
    }
    return $code;
  }
  public static function TheoAccount($id)
  {
    $a=Classroom::find($id)->theoAccount;
    return $a->hoten;
  }

  public static function LayTenTheoMa($id)
  {
    $account= Account::where('id',$id)->first();
    return $account->hoten;
  }

  public function dsSinhVien(Request $req)
  {
    $lstStudent= Classroom::find($req->id)->dsStudentJoined;
    return View('Teacher/ListStudent',compact('lstStudent'));
  }
  public function layDSSVTL (Request $req)
  {
    $lstStudent= Classroom::find($req->id)->dsStudentJoined;
    return View('SCL',compact('lstStudent'));
  }

}
