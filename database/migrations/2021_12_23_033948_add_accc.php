<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class AddAccc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $account=new Account();
        $account->username="giaovien1";
         $account->password=Hash::make("12345");
         $account->hoTen="Thái Thanh Bạch";
         $account->ngaysinh="2001-04-09";
         $account->diachi="Núi Cấm";
         $account->sdt="0397717100";
         $account->email="bachnek@gmail.com";
        $account->accounttype=3;
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
