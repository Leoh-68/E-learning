<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
class AddAccount extends Migration
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
      $account->hoTen="Trần Phước Khánh";
      $account->ngaysinh="2001-11-11";
      $account->diachi="Nhà khánh";
      $account->sdt="029284723";
      $account->email="khanhahihia@gmail.com";
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
