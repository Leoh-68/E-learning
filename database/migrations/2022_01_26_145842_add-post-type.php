<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('posttype','type')) {
            return;
        }
        Schema::create('posttype', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::table('post', function (Blueprint $table) {
            
            $table->integer('posttype');
            $table->foreign('posttype')->references('id')->on('posttype');
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
