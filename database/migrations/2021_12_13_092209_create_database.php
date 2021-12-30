<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('hoten');
            $table->date('ngaysinh');
            $table->string('diachi')->nullable();
            $table->string('sdt');
            $table->string('email');
            $table->integer('accounttype');
            $table->foreign('accounttype')->references('id')->on('accounttype');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('accounttype', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });
        Schema::create('classroom', function (Blueprint $table) {
            $table->id();
            $table->integer('idaccount');
            $table->string('name');
            $table->string('malop');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('studentlist', function (Blueprint $table) {
            $table->id();
            $table->integer('stt');
            $table->integer('idaccount');
            $table->foreign('idaccount')->references('id')->on('account');
            $table->integer('idclassroom');
            $table->foreign('idclassroom')->references('id')->on('classroom');
        });
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('mota');
            $table->integer('idclassroom');
            $table->foreign('idclassroom')->references('id')->on('classroom');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->integer('idpost');
            $table->foreign('idpost')->references('id')->on('post');
            $table->integer('idaccount');
            $table->foreign('idaccount')->references('id')->on('account');
            $table->string('comment');
            $table->timestamps();
            $table->SoftDeletes();
        });
        
        Schema::create('attachment', function (Blueprint $table) {
            $table->id();
            $table->integer('idpost');
            $table->foreign('idpost')->references('id')->on('post');
            $table->string('attachment');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
