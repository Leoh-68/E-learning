<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Classroom;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Account;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Thêm post
    public function post(Request $req)
    {
        $account = Account::where('username', $req->session()->get('username'))->first();
        $type = 0;
        if ($req->type == "Thông báo") {
            $type = 2;
        }
        else
        {
            $type = 1;
        }
        if($type==0)
        {
            session()->flash('fail', 'Sai phần loại bài đăng');
        }
        $idclass = Classroom::where('malop', $req->id)->first();
        $req->validate([
            'post' => 'required',
            'name' => 'required',
            'post.required' => 'vui lòng nhập đầy đủ thông tin',
            'name.required' => 'vui lòng nhập đầy đủ thông tin',
        ]);
        $post = new Post();
        $post->ten = $req->name;
        $post->mota = $req->post;
        $post->idclassroom = $idclass->id;
        $post->posttype=$type;
        $post->save();
        if ($req->has('image')) {
            $size = $req->image->getSize();
            $extention       = $req->image->extension();
            if ($size > 2000000) {
                session()->flash('fail', 'Kích thướt ảnh phải dưới 2M');
                return View('Teacher/Post', compact('idclass'));
            }
            $attach = new Attachment();
            $image = $req->image;
            $image_name = $image->getClientoriginalName();
            $image->move(public_path('images/PostFile'), $image_name);
            $attach->attachment = $image_name;
            $attach->idpost = $post->id;
            $attach->idaccount=$account->id;
            $attach->save();
        }
        session()->flash('success', 'Đăng thành công');
        return redirect()->route('showSingleClass', ['id' => $req->id]);
    }
    //Sửa post
    public function updatePostShow(Request $req)
    {
        $post = Post::find($req->id);
        return view('Teacher/updatePost', compact('post'));
    }
    public function updatePost(Request $req)
    {
        $type = 0;
        if ($req->type =="Thông báo") {
            $type = 2;
        }
        else
        {
            $type = 1;
        }
        if($type==0)
        {
            session()->flash('fail', 'Sai phần loại bài đăng');
        }
        $idclass = Classroom::where('id', $req->code)->first();
        $req->validate([
            'mota' => 'required',
            'name' => 'required',
        ], [
            'mota.required' => 'vui lòng nhập đầy đủ thông tin',
            'name.required' => 'vui lòng nhập đầy đủ thông tin',
        ]);
        $post = Post::where('id', $req->id)->first();
        $post->ten = $req->name;
        $post->mota = $req->mota;
        $post->posttype=$type;
        $post->save();
        if ($req->has('image')) {
            $size = $req->image->getSize();
            $extention = $req->image->extension();
            if ($size > 2000000) {
                session()->flash('fail', 'Kích thướt ảnh phải dưới 2M');
                return View('Teacher/Post', compact('idclass'));
            }
            $attach = Attachment::where('idpost', $post->id)->first();
            $image = $req->image;
            $image_name = $image->getClientoriginalName();
            $image->move(public_path('images/PostFile'), $image_name);
            $attach->attachment = $image_name;
            $attach->save();
        }
        session()->flash('success', 'Sửa thành công');
        return redirect()->route('showSingleClass', ['id' => $idclass->malop]);
    }
    //Chuyển trang bài đăng
    public function showPost(Request $req)
    {
        $idclass = $req->id;
        return View('Teacher/Post', compact('idclass'));
    }
    //Xóa post
    public function deletePost(Request $req)
    {
        $idclass = Classroom::where('id', $req->code)->first();
        $post = Post::where('id', $req->id)->first();
        $post->delete();
        if (Attachment::where('idpost', $post->id)->count() != 0) {
            $attach = Attachment::where('idpost', $post->id)->first();
            $attach->delete();
        };
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('showSingleClass', ['id' => $idclass->malop]);
    }
    //Lấy tệp theo id post
    public static function attachmentfromID($id)
    {
        $att = Post::find($id)->dsTep;
        
        if ($att == null) {
            return $att;
        }
        return $att->attachment;
    }
    //Hiện post theo id
    public function singlePost(Request $req)
    {
        $post = Post::find($req->id);
        $cmt = Comment::orderBy('created_at', 'desc')->where('idpost', $post->id)->get();
        return view('Teacher/PostView', compact('post', 'cmt'));
    }
    public function singlePostStudent(Request $req)
    {
        $account = Account::where('username', session('username'))->first();
        $post = Post::find($req->id);
        $cmt = Comment::orderBy('created_at', 'desc')->where('idpost', $post->id)->get();
        $att=Attachment::where([['idpost',$post->id],['idaccount',$account->id]])->count();
        return view('student/PostStudent', compact('post', 'cmt','att'));
    }
    //Sao chép bài đăng
    public function copyPostShow(Request $req)
    {
        $account = Account::where('username', session('username'))->first();
        $post=Post::find($req->id);
        $class=Classroom::where('idaccount',$account->id)->get();
        return View('Teacher/CopyPost',compact('post','class'));
    }
    public function copyPost(Request $req)
    {
        $account = Account::where('username', $req->session()->get('username'))->first();
        $post=Post::find($req->id);
        $class=Classroom::where('malop',$req->class)->first();
        $postcopy=new Post();
        $postcopy->ten =  $post->ten;
        $postcopy->mota = $post->mota;
        $postcopy->idclassroom = $class->id;
        $postcopy->posttype=$post->posttype;
        $postcopy->save();
        $attachpost=Attachment::where('idpost',$req->id)->count();
        if($attachpost!=0)
        {
            $att=Attachment::where('idpost',$req->id)->first();
            $attach= new Attachment();
            $attach->attachment=$att->attachment;
            $attach->idpost=$postcopy->id;
            $attach->idaccount=$account->id;
            $attach->save();
        }
        session()->flash('success', 'Sao chép thành công');
        return redirect()->back();
    }
    //Nộp bài tập
    public function homeWork (Request $req)
    {
        $account = Account::where('username', $req->session()->get('username'))->first();
        if ($req->has('image')) {
            $size = $req->image->getSize();
            $extention = $req->image->extension();
            $image = $req->image;
            $image_name = $image->getClientoriginalName();
            $image->move(public_path('images/PostFile'), $image_name);
            $attach= new Attachment();
            $attach->attachment=$image_name;
            $attach->idpost=$req->id;
            $attach->idaccount=$account->id;
            $attach->save();
            session()->flash('success', 'Nộp bài thành công');
            return redirect()->back();
        }
        else
        {
            session()->flash('fail', 'Chưa chọn tệp ');
            return redirect()->back();
        }
    }
}
