<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Post;
use App\Models\Classroom;
use App\Models\Attachment;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Hiện post
    public function post(Request $req)
    {
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
        $post->save();

        if ($req->has('image')) {
            $size = $req->image->getSize();
            $extention = $req->image->extension();
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
        $idclass = Classroom::where('id', $req->code)->first();
        $req->validate([]);
        $post = Post::where('id', $req->id)->first();
        $post->ten = $req->name;
        $post->mota = $req->mota;
        $post->save();
        session()->flash('sussecc', 'Sửa thành công');
        return redirect()->route('showSingleClass', ['id' => $idclass->malop]);
    }
    //Chuyển trang bài đăng
    public function showPost(Request $req)
    {
        $idclass = $req->id;
        return View('Teacher/Post', compact('idclass'));
    }
    //Xóa post

    //Lấy tệp theo id post
    public function attachmentfromID($id)
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
        $post=Post::find($req->id);
        $cmt=Comment::orderBy('created_at', 'desc')->where('idpost',$post->id)->get();
        return view('Teacher/PostView',compact('post','cmt'));
    }

}
