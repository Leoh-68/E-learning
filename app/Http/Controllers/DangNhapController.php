<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Http\Requests\DangNhapRequest;
use App\Http\Requests\EmailRequest;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\Session;

// Bạch: Ngộ thêm cả thư mục fonts(~E-learning\public\fonts)
// và vendor(~E-learning\public\vendor) nhưng ghi chú hết thì trầm cảm lắm
class DangNhapController extends Controller
{
    public function dangNhap()
    {
        return view('login');
    }
    public function messages()
    {
        return [
            'username.required' => 'Chưa nhập tên đăng nhập',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min'=>'Password chứa ít nhất 5 ký tự',
            'email.required' => 'Chưa nhập email',
            'email.gmail' => 'Định dạng email không đúng',
        ];
    }

    public function xuLyDangNhap(DangNhapRequest $request)
    {
        $validated = $request->validated();
        if (Auth::attempt(['username' =>$request->username, 'password' =>  $request->password])) {
            session(['username' => $request->username]);
            session(['password' => $request->username]);
            if(Auth::user()->accounttype==2) {
                return redirect()->route('showClass');
            } else if(Auth::user()->accounttype==1) {
                return redirect()->route('Admin');
            } else {
                return  redirect()->route('showClassStudent');
            }
        }
        return redirect()->route('login')->with('Text','Username hoặc password không tồn tại');
    }

    public function forgotPassword()
    {
        return view('ForgotPassword');
    }

    public function xuLyMatKhau(EmailRequest $request)
    {

        $validated = $request->validated();
        $user = Account::where('email',$request->email)->first();
        if(!empty($user)||$user->email == $request->email){
                Mail::send('SendMail',compact('user'),function($email) use($user){
                    $email->subject('E-learning - Quên mật khẩu');
                    $email->to($user->email,$user->hoten);
                });
            return redirect()->route('login')->with('title', 'Vui lòng kiểm tra hòm thư của bạn!!!');
        }

        return redirect()->route('ForgotPassword')->with('title','Email không tồn tại');
    }

    public function guiMail($id)
    {
        $user = Account::find($id);
        Mail::send('SendMail',compact('user'),function($email) use($user){
            $email->subject('Forgot Password');
            $email->to($user->email,$user->hoTen);
        });
    }

    public function Password($id)
    {
        $user = Account::find($id);
        return view('Password',compact('user'));
    }

    public function taoMoiMatKhau(Request $request,$id)
    {

        $request->validate([
            'password' => 'required|min:5',
            'password2' => 'required|min:5'
        ]
        );
        $user = Account::find($id);
        if($request->password!=$request->password2){
            $title = " Password không khớp";
            return view('Password',compact('title','user'));
         }else{
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('title', 'Cập nhật mật khẩu thành công');
         }
    }

    //Cái này là đăng xuất
    public function dangXuat()
    {
        Auth::logout();
        $session = session()->forget('username');
        $session1 = session()->forget('password');
        $session2 = session()->forget('ajs_anonymous_id');
        $session3 = session()->forget('XSRF-TOKEN');
        $session4 = session()->forget('laravel_session');
        $session5 = session()->forget('1P_JAR');
        return redirect()->route('Wellcome')->withSession($session)->withSession($session1)
        ->withSession($session2)->withSession($session3)->withSession($session4)->withSession($session5);
    }

    public function taoTaiKhoan(Request $request)
    {
        return view('Create');
    }

    public function xlTaoTaiKhoan(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $user = Account::where('username',$request->username)->first();
        $user2 = Account::where('email',$request->email)->first();

        if(empty($user) && empty($user2)){
            if($request->password!=$request->password2){
                return redirect()->route('Create')->with('message', 'Password không khớp!!!');
            }else if(strlen($request->phone)<10||strlen($request->phone)>10)
            {
                return redirect()->route('Create')->with('message', 'SDT không hợp lệ!!!');
            }
            // else if($request->day >= $dt)
            // {
            //     return redirect()->route('Create')->with('message1', 'Ngày lớn hơn ngày hiện tại!!!');
            // }
            else{
             $account=new Account();
             $account->hoten=$request->fullname;
             $account->username=$request->username;
             $account->email=$request->email;
             $account->password=Hash::make($request->password);
             $account->accounttype = 3;
             $account->ngaysinh=$request->day;
             $account->diachi=$request->address;
             $account->sdt=$request->phone;
             $account->hinhanh='3.jpg';
             $account->save();
             return redirect()->route('login')->with('title', 'Tạo tài khoản thành công');
            }
        }
        return redirect()->route('Create')->with('message', 'Username hoặc email đã tồn tại!!!');

    }
}
