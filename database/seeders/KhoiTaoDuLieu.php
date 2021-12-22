<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KhoiTaoDuLieu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<4;$i++){
            $type=Str::random(10);
            DB::table('accounttype')->insert([
                'type'=>$type,
            ]);
        }
        for($i=1;$i<6;$i++){
            $username=Str::random(10);
            $password=Str::random(5);
            $hoten=Str::random(10);
            $ngaysinh=date("Y-m-d");
            $diachi=Str::random(10);
            $sdt="0123456789";
            $email="abc@gmail.com";
            $type=rand(1,3);
            $created_at=date("Y-m-d");
            DB::table('account')->insert([
                'username'=>$username,
                'password'=>$password,
                'hoten'=>$hoten,
                'ngaysinh'=>$ngaysinh,
                'diachi'=>$diachi,
                'sdt'=>$sdt,
                'email'=>$email,
                'accounttype'=>$type,
                'created_at'=>$created_at,
            ]);
        }
        for($i=1;$i<6;$i++){
            $idaccount=rand(1,5);
            $name=Str::random(5);
            $malop=Str::random(10);
            $created_at=date("Y-m-d");
            DB::table('classroom')->insert([
                'idaccount'=>$idaccount,
                'name'=>$name,
                'malop'=>$malop,
                'created_at'=>$created_at,
            ]);
        }
        for($i=1;$i<6;$i++){
            $stt=$i;
            $idaccount=$i;
            $idclassroom=rand(1,5);
            DB::table('studentlist')->insert([
                'stt'=>$stt,
                'idaccount'=>$idaccount,
                'idclassroom'=>$idclassroom,
            ]);
        }
        for($i=1;$i<6;$i++){
            $ten=Str::random(10);
            $mota=Str::random(5);
            $idclassroom=rand(1,5);
            $created_at=date("Y-m-d");
            DB::table('post')->insert([
                'ten'=>$ten,
                'mota'=>$mota,
                'idclassroom'=>$idclassroom,
                'created_at'=>$created_at,
            ]);
        }
        for($i=1;$i<6;$i++){
            $idpost=rand(1,5);
            $idaccount=rand(1,5);
            $comment=Str::random(10);
            $created_at=date("Y-m-d");
            DB::table('comment')->insert([
                'idpost'=>$idpost,
                'idaccount'=>$idaccount,
                'comment'=>$comment,
                'created_at'=>$created_at,
            ]);
        }
        for($i=1;$i<6;$i++){
            $idpost=rand(1,5);
            $attachment=Str::random(10);
            $created_at=date("Y-m-d");
            DB::table('attachment')->insert([
                'idpost'=>$idpost,
                'attachment'=>$attachment,
                'created_at'=>$created_at,
            ]);
        }
    }
    
}
