<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;
class Acc2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    $account=new Account();
      $account->username="admin";
      $account->password=Hash::make("admin");
      $account->hoTen="Nguyễn Đức Huy";
      $account->ngaysinh="2001-2-3";
      $account->diachi="Nhà Huy";
      $account->sdt="023342723";
      $account->email="Huynehihi@gmail.com";
      $account->accounttype=2;
    $account->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
