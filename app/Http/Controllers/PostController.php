<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Classroom;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
}
