<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Account;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Attachment;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Models\StudentList;
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
        $lst = Classroom::where('deleted_at','=',null)->get();
        return View('admin/ClassroomsList', compact('lst'));
    }
    public static function TheoIdAccount($idaccount,$idclass)
    {
        $account = StudentList::where([['idaccount','=',$idaccount],['idclassroom','=',$idclass]])->first();
        if($account->waitingqueue==false){
            return "Chưa xác nhận";
        }
        else{
            return "Đã xác nhận";
        }
    }
    /*Lớp của sinh viên*/
    // Thêm lớp
    public function addClass(Request $req)
    {
        $image_name="";
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
            $image->move(public_path('images/Classroom'), $image_name);
        }
        else
        {
            $image_name="bg.jpg";
        };
        $listClass = Classroom::all();
        foreach($listClass as $item)
        {
            if($item->malop==$req->classcode)
            {
                session()->flash('fail', 'MÃ lớp đã tồn tại');
                return redirect()->route('Addclass');
            }

        }
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
    //Hiện thông tin lớp Giáo viên thei mã lớp
    public function showSingleClass(Request $req)
    {
        $class = Classroom::where('malop', '=', $req->id)->get();
        $idclass = Classroom::where('malop', '=', $req->id)->first();
        $post = Post::orderBy('created_at', 'desc')->where('idclassroom', $idclass->id)->get();
        return View('Teacher/Class', compact('class', 'post'));
    }

    //Hiện thông tin lớp Giáo viên thei id lớp
    public function showSingleClassId(Request $req)
    {
        $class = Classroom::find($req->id);
        $idclass = Classroom::where('malop', '=', $req->id)->first();
        $post = Post::orderBy('created_at', 'desc')->where('idclassroom', $req->id)->get();
        return View('Teacher/Class', compact('class', 'post'));
    }

    public static function Trans($id)
    {
        $class = Classroom::find($id);

        return $class->malop;
    }
    //Hiện thông tin lớp Học sinh
    public function showSingleClassStudent(Request $req)
    {
        $class = Classroom::where('malop', '=', $req->id)->get();
        $idclass = Classroom::where('malop', '=', $req->id)->first();
        $post = Post::orderBy('created_at', 'desc')->where('idclassroom', $idclass->id)->get();
        return View('Student/ClassStudent', compact('class', 'post'));
    }
    //Cập nhật lớp
    public function updateClass(Request $req)
    {
        $req->validate([
            'classname' => 'required',
            'username' => 'required',
            'classname.required' => 'Vui lòng nhập đầy đủ tên lớp',
        ]);

        if ($req->has('image')) {
            $image = $req->image;
            $image_name = $image->getClientoriginalName();
            $image->move(public_path('images/Classroom'), $image_name);
            $class = Classroom::where('malop', '=', $req->id)->first();
            $class->name = $req->classname;
            $class->hinhanh=$image_name;
            $class->save();
        }
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
        $post=Post::where('idclassroom',$class->id)->get();
        foreach($post as $var)
        {
            $cmt=Comment::where('idpost',$var->id)->get();
            foreach($cmt as $item)
            {
                $item->delete();
            }
            $var->delete();
        }
        $class->delete();
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
    //Lấy hình ảnh theo mã tài khoản
    public static function LayHinhTheoMa($id)
    {
        $account = Account::where('id', $id)->first();
        return $account->hinhanh;
    }

    public function layDSSVTL(Request $req)
    {
        $lstStudent = Classroom::find($req->id)->dsStudentJoined;
        return View('admin/SCL', compact('lstStudent'));
    }
    public function layDSBG(Request $req)
    {
        $lstBaiGiang = Post::where([['idclassroom','=',$req->id],['posttype','=',2]])->get();
        return View('admin/BaiGiang', compact('lstBaiGiang'));
    }
    public function layDSBT(Request $req)
    {
        $lstBaiTap = Post::where([['idclassroom','=',$req->id],['posttype','=',1]])->get();
        return View('admin/BaiTap', compact('lstBaiTap'));
    }
    // Danh sách học sinh được chấp nhận
    public function listStudent(Request $req)
    {
        $malop=$req->id;
        $student = Classroom::where('malop', $req->id)->first();
        $lst = Classroom::find($student->id)->dsStudentJoined;
        $classname=$student->name;
        $account = Account::where('username', session('username'))->first();
        $accountname=$account->hoten;
        // Truy cập thuộc tính bảng trung gian
        $lstStudent = $lst->reject(function ($value, $key) {
            return $value->pivot->waitingqueue == 0;
        });
        return View('Teacher/ListStudent', compact('lstStudent','classname','accountname','malop'));
    }
    // Danh sách học sinh đang chờ
    public function listStudentWaiting(Request $req)
    {

        $account = Account::where('username', session('username'))->first();
        $accountname=$account->hoten;
        $student = Classroom::where('malop', $req->id)->first();
        $classname=$student->name;
        $lst = Classroom::find($student->id)->dsStudentJoined;
        // Truy cập thuộc tính bảng trung gian
        $lstStudent = $lst->reject(function ($value, $key) {
            return $value->pivot->waitingqueue == 1;
        });
        return View('Teacher/waitingroom', compact('lstStudent','classname','accountname'));
    }
    //Chech thông tin phiên bản php
    public function phpinfo()
    {
        return phpinfo();
        return View('Teacher/waitingroom  ', compact('lstStudent'));
    }
    //Gủi mail
    public function sendMail(Request $req)
    {
        $checkLoopMail = "";
        $listaccount = StudentList::all();
        $idclass = Classroom::where('malop', $req->id)->first();
        $listEmail = explode(",", $req->textinput);
        foreach ($listEmail as $item) {
            $allacc = Account::where([['email', $item],['accounttype',3]])->first();
            if ($allacc == null) {
                Cookie::queue('error', "Email $item không tồn tại", 0.09);
                return  redirect()->route('lstStudent', ['id' => $req->id]);
            }
            foreach ($listaccount as $var) {
                if ($var->idaccount == $allacc->id && $var->idclassroom == $idclass->id || $var->deleted_at != null) {

                    Cookie::queue('error', "Tài khoản có mail $item đã tồn tại", 0.09);
                    return  redirect()->route('lstStudent', ['id' => $req->id]);
                }
            }
            if ($item == $checkLoopMail) {
                Cookie::queue('error', "Vui lòng không nhập trùng email [ $item ]", 0.09);
                return  redirect()->route('lstStudent', ['id' => $req->id]);
            } else {
                $checkLoopMail = $item;
            }
        }
        $idclasss=$idclass->id;
        $classname=$idclass->name;
        $username=$req->name;
        foreach($listEmail as $var){
            $account=Account::where('email',$var)->first();
            $id=$account->id;
            Mail::send('Teacher/MailContent',compact('username','classname','id','idclasss'),function($Email) use ($var)
            {
                $Email->to($var);
            });
        }
        session()->flash('success','Gửi yêu cầu thành công');
        return  redirect()->route('lstStudent', ['id' => $idclass->malop]);
    }
    //Chấp nhập vào lớp
    public function Acp(Request $req)
    {
        $class=Classroom::find($req->idclass);
        $studentlis = new StudentList;
        $studentlis->stt = 1;
        $studentlis->idaccount = $req->id;
        $studentlis->idclassroom = $req->idclass;
        $studentlis->waitingqueue = 1;
        $studentlis->save();
        session()->flash('success', ' Thành công');
        return redirect()->route('Logout');
    }
    //Xem chi tiết bài đăng
    public function XCTBG($id1,$id2)
    {
        {
            $post = Post::find($id2);
            return view('admin/XCTBG',compact('post'));
        }
    }
    public function XCTBT($id1,$id2)
    {
        {
            $post = Post::find($id2);
            return view('admin/XCTBT',compact('post'));
        }
    }
    //Xem danh sách học sinh đã nộp bài tập
    public function ListHomeWork(Request $req)
    {
        // $ds= collect();
        // $homework=Post::where([['posttype','1'],['id',$req->id]])->first();
        // $studentid=StudentList::where('idclassroom',$req->idclass)->get();
        // foreach($studentid as $var)
        // {
        //     $a=Account::find($var->idaccount);
        //     $ds->push($a);
            
        // }
        // return $studentid;
        $malop=$req->idclass;
        $student = Classroom::where('id', $req->idclass)->first();   
        $lsta = Classroom::find($student->id)->dsStudentJoined;
        $lst=$lsta->where('deleted_at',null);    
        $classname=$student->name;
        $account = Account::where('username', session('username'))->first();
        $accountname=$account->hoten;
        // Truy cập thuộc tính bảng trung gian
        $lstStudent = $lst->reject(function ($value, $key) {
            return $value->pivot->waitingqueue == 0;
        });
        $ds= collect();
        $attach=Attachment::where('idpost',$req->idpost)->get();
        foreach($attach as $var)
        {
            if($var->idaccoun!=0)
            {
                $acc=Account::where(['idaccount',$var->idaccount])->first();
                $ds->push($acc);
            }
        }
        dd($ds);
        return view('Teacher/ListHW',compact('lstStudent','ds'));
        ;
    }
}
