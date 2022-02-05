<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('account','hinhanh')) {
            return;
        }
        Schema::table('account', function (Blueprint $table) {
            $table->string('hinhanh');
        });
        if (Schema::hasColumn('classroom','hinhanh')) {
            return;
        }
        Schema::table('classroom', function (Blueprint $table) {
            $table->string('hinhanh');
        });
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
