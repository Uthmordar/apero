<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
            Schema::create('users', function($table){
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('password');
                $table->enum('status', array('offline', 'online'))->default('offline');
                $table->enum('role', array('visitor', 'administrator'))->default('visitor');
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
            Schema::drop('users');
	}

}
