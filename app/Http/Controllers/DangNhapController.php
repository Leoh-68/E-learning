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
                // dd($request);
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
        $cookie = session()->forget('username');
        $cookiep = session()->forget('password');
        $cookie2 = session()->forget('ajs_anonymous_id');
        $cookie3 = session()->forget('XSRF-TOKEN');
        $cookie4 = session()->forget('laravel_session');
        $cookie5 = session()->forget('1P_JAR');
        return redirect()->route('Wellcome')->withSession($cookie)->withSession($cookiep)
        ->withSession($cookie2)->withSession($cookie3)->withSession($cookie4)->withSession($cookie5);  
    }

}
