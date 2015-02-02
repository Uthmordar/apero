<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAperosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('aperos', function($table){
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->string('title', 50);
            $table->text('abstract');
            $table->text('content');
            $table->string('url_thumbnail');
            $table->timestamp('date');
            $table->enum('status', array('publish', 'unpublish', 'trash'))->default('unpublish');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropifExists('aperos');
    }
}
