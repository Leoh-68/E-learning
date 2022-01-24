<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Classroom;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Hiện post
    public function post(Request $req)
    {
        $idclass = Classroom::where('malop', $req->id)->first();
        $req->validate([
            'post' => 'required',
            'name' => 'required'
        ]);
        $post = new Post();
        $post->ten = $req->name;
        $post->mota = $req->post;
        $post->idclassroom = $idclass->id;
        $post->save();
        session()->flash('success', 'Đăng thành công');
        return redirect()->route('showSingleClass', ['id' => $req->id]);
    }
    //Sửa post
    public function updatePostShow(Request $req)
    {
        $post=Post::find($req->id);
        return view('Teacher/updatePost',compact('post'));
    }
    public function updatePost(Request $req)
    {
        $idclass = Classroom::where('id', $req->code)->first();


        $req->validate([
        ]);
        $post=Post::where('id',$req->id)->first();
        $post->ten=$req->name;
        $post->mota=$req->mota;
        $post->save();
        session()->flash('sussecc','Sửa thành công');
        return redirect()->route('showSingleClass', ['id' => $idclass->malop]);
    }
}
