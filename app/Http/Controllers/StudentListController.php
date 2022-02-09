<?php

namespace App\Http\Controllers;

use App\Models\StudentList;
use App\Models\Account;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StudentListController extends Controller
{
    //Thêm học sinh
    public function AddStudent(Request $req)
    {
        $listaccount = StudentList::all();
        $checkLoopMail = "";
        $idclass = Classroom::where('malop', $req->id)->first();
        $listEmail = explode(",", $req->textinput);
        //Check danh sách Email hợp lệ
        foreach ($listEmail as $item) {
            $allacc = Account::where('email', $item)->first();
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
        //Add danh sách Email hợp lệ
        foreach ($listEmail as $item) {
            $studentlis = new StudentList;
            $allacc = Account::where('email', $item)->first();
            $studentlis->stt = 1;
            $studentlis->idaccount = $allacc->id;
            $studentlis->idclassroom = $idclass->id;
            $studentlis->waitingqueue = 0;
            $studentlis->save();
        }
        session()->flash('success', ' Thành công');
        return redirect()->route('lstStudentWating', ['id' => $req->id]);
    }
    //Xóa học sinh
    public function DeleteStudent(Request $req)
    {
        $idclass = Classroom::where('malop', $req->code)->first();
        $a = StudentList::where([['idaccount', $req->id], ['idclassroom', $idclass->id]])->delete();
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('lstStudent', ['id' => $req->code]);
    }

    public function AddStudentAdmin(Request $req)
    {
        $studentlis = new StudentList;
        $allacc = Account::where([['email', '=', $req->textinput], ['deleted_at', '=', null]])->first();
        if ($allacc == null) {
            return view('admin/UnknowAccount');
        }
        $studentlis->stt = 1;
        $studentlis->idaccount = $allacc->id;
        $studentlis->idclassroom = $req->id;
        $studentlis->save();
        return redirect()->route('loadDSSV', ['id' => $req->id]);
    }
    public function DeleteStudentAdmin(Request $req)
    {
        $a = StudentList::where('idaccount', $req->id)->delete();
        return redirect()->route('loadDSSV', ['id' => $req->code]);
    }
    //Chấp thuận yêu cầu vào lớp
    public function acceptStudent(Request $req)
    {
        $class = Classroom::where('malop', $req->class)->first();
        $a = StudentList::where([['idaccount', $req->account], ['idclassroom', $class->id]])->first();
        $a->waitingqueue = 1;
        $a->save();
        return  redirect()->route('lstStudent', ['id' => $req->class]);
    }
    //Tìm kiếm học sinh
    public function findStudent(Request $req)
    {
            $malop=$req->id;
            $student = Classroom::where('malop', $req->id)->first();
            $lsta = Classroom::find($student->id)->dsStudentJoined;
            $lst=$lsta->where('email','like','%' . 'a' . '%')->get();
            dd($lst);
            $classname=$student->name;
            $account = Account::where('username', session('username'))->first();
            $accountname=$account->hoten;
            // Truy cập thuộc tính bảng trung gian
            $lstStudent = $lst->reject(function ($value, $key) {
                return $value->pivot->waitingqueue == 0;
            });
            return View('Teacher/ListStudent', compact('lstStudent','classname','accountname'));
    }
}
