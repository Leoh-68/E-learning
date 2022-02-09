<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Comment;
use Illuminate\Http\Request;
class CommentController extends Controller
{
       //Thêm bình luận
       public function addComment(Request $req)
       {
           $idaccount=$req->idaccount;
           $idpost=$req->idpost;
           $comment=$req->comment;
           $cmt= new Comment();
           $cmt->idpost=$idpost;
           $cmt->idaccount=$idaccount;
           $cmt->comment=$comment;
           $cmt->save();
           session()->flash('success','Bình luận thành công');
           return redirect()->route('ViewPost',['id'=>$idpost]);
       }
       //Lấy tên tài khoản theo id
       public static function layTenAccTheoID($id)
       {
          $name=Account::find($id);
          return $name->hoten;
       }


       //Sửa bình luận
       public function updateCommentShow(Request $req)
       {
        $cmt=Comment::find($req->idcomment);
        return view('/Teacher/updateComment',compact('cmt'));
       }
       public function updateComment(Request $req)
       {
        $account=Account::where('username',session('username'))->first();
        $post=Comment::find($req->idcomment)->Post;
        $comment=Comment::find($req->idcomment);
        $comment->comment=$req->comment;
        $comment->save();
        session()->flash('success','Sửa bình luận thành công');
        return  redirect()->route('ViewPost',['id'=>$post->id]);
       }
       //Xóa bình luận
       public function deleteComment(Request $req)
       {

        $post=Comment::find($req->idcomment)->Post;
        $comment=Comment::find($req->idcomment);
        $comment->delete();
        session()->flash('success','Xóa bình luận thành công');
        return  redirect()->route('ViewPost',['id'=>$post->id]);
       }
}
