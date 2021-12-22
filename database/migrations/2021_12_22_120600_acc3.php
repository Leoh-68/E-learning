<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;
class Acc3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $account=new Account();
        $account->username="sinhvien";
        $account->password=Hash::make("admin");
        $account->hoTen="Thái Thanh Bạch";
        $account->ngaysinh="2001-2-3";
        $account->diachi="Nhà Bạch";
        $account->sdt="02342342323";
        $account->email="Bachnehihi@gmail.com";
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
