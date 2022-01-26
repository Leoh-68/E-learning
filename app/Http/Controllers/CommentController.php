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
       public function layTenAccTheoID($id)
       {
          $name=Account::find($id);
          return $name->hoten;
       }
}
