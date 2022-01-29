<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Account;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    public function Classroom()
    {
        return view('Teacher/Class');
    }
    public function getUpdateClass(Request $req)
    {
        $class = Classroom::where('malop', '=', $req->id)->get();
        return View('Teacher/UpdateClass', compact('class'));
    }
    /*Lớp của giáo viên*/
    public function showClass(Request $request)
    {
        $account = Account::where('username', $request->session()->get('username'))->first();
        $classlst = Classroom::where('idaccount', $account->id)->get();
        return View('Teacher/HomePage', compact('classlst'));
    }
    /*Lớp của admin*/
    public function layDSLopHoc()
    {
        $lst = Classroom::all();
        return View('admin/ClassroomsList', compact('lst'));
    }
    /*Lớp của sinh viên*/
    // Thêm lớp
    public function addClass(Request $req)
    {
        $req->validate([
            'classname' => 'required',
            'classcode' => 'required|max:6|min:6'
        ], [
            'classname.required' => 'Vui lòng nhập đầy đủ tên lớp',
            'classcode.required' => 'Vui lòng nhập đầu đủ mã lớp',
            'classcode.min' => 'Mã lớp phải có :min ký tự',
            'classcode.max' => 'Mã lớp phải có :max ký tự'
        ]);
        // Upload ảnh
        if ($req->has('image')) {
            $image = $req->image;
            $image_name = $image->getClientoriginalName();
            $image->move(public_path('images'), $image_name);
        }
        $listClass = Classroom::where('malop', $req->classcode)->first();
        // if($listClass!=null )
        // {
        //   Cookie::queue('error',"Lớp này đã tồn tại hoặc bị xóa",0.09);
        // }
        // if($listClass!=null && $listClass->deleted_at=!null)
        // {
        //   return 0;
        // }
        // *******
        // if($listClass!=null&&  $listClass->deleted_at==null )
        // {
        //   return 0;
        // }
        $account = Account::where('username', session('username'))->first();
        $class = new Classroom;
        $class->idaccount = $account->id;
        $class->name = $req->classname;
        $class->malop = $req->classcode;
        $class->hinhanh = $image_name;
        $class->save();
        session()->flash('success', 'Thêm thành công');
        return redirect()->route('showClass');
    }
    //Hiện thông tin lớp Giáo viên
    public function showSingleClass(Request $req)
    {
        $class = Classroom::where('malop', '=', $req->id)->get();
        $idclass = Classroom::where('malop', '=', $req->id)->first();
        $post=Post::orderBy('created_at', 'desc')->where('idclassroom',$idclass->id)->get();
        return View('Teacher/Class', compact('class','post'));
    }
    //Hiện thông tin lớp Học sinh
    public function showSingleClassStudent(Request $req)
    {
        $class = Classroom::where('malop', '=', $req->id)->get();
        return View('Student/ClassStudent', compact('class'));
    }
    //Cập nhật lớp
    public function updateClass(Request $req)
    {
        $req->validate([
            'classname' => 'required',
            'username' => 'required',
            'classname.required' => 'Vui lòng nhập đầy đủ tên lớp',
        ]);
        $class = Classroom::where('malop', '=', $req->id)->first();
        $class->name = $req->classname;
        $class->save();
        session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('showClass');
    }
    // Xóa lớp
    public function deleteClass(Request $req)
    {
        $class = Classroom::where([['malop', '=', $req->id], ['deleted_at', null]])->first();
        $class->deleted_at = Carbon::now();
        $class->save();
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('showClass');
    }
    // Tạo random mã lớp
    public static function randomCode()
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $class = Classroom::all();
        $code = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);
        foreach ($class as $var) {
            while ($var->malop == $class) {
                $code = rand(6);
            }
        }
        return $code;
    }
    // Lấy tên lớp theo mã tài khoản
    public static function TheoAccount($id)
    {
        $a = Classroom::find($id)->theoAccount;
        return $a->hoten;
    }
    // Lấy tên Tài khoản theo mã tài khoản
    public static function LayTenTheoMa($id)
    {
        $account = Account::where('id', $id)->first();
        return $account->hoten;
    }

    public function layDSSVTL(Request $req)
    {
        $lstStudent = Classroom::find($req->id)->dsStudentJoined;
        return View('SCL', compact('lstStudent'));
    }
    // Danh sách học sinh được cah61p nhận
    public function listStudent(Request $req)
    {
        $student = Classroom::where('malop', $req->id)->first();
        $lst = Classroom::find($student->id)->dsStudentJoined;
        // Truy cập thuộc tính bảng trung gian
        $lstStudent = $lst->reject(function ($value, $key) {
            return $value->pivot->waitingqueue == 0;
        });
        return View('Teacher/ListStudent', compact('lstStudent'));
    }
    // Danh sách học sinh đang chờ
    public function listStudentWaiting(Request $req)
    {
        $student = Classroom::where('malop', $req->id)->first();
        $lst = Classroom::find($student->id)->dsStudentJoined;
        // Truy cập thuộc tính bảng trung gian
        $lstStudent = $lst->reject(function ($value, $key) {
            return $value->pivot->waitingqueue == 1;
        });
        return View('Teacher/waitingroom  ', compact('lstStudent'));
    }
}
