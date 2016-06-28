<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subscribe');
			$table->string('openid')->unique();
			$table->string('nickname');
			$table->string('sex');
			$table->string('city');
			$table->string('country');
			$table->string('province');
			$table->string('language');
			$table->string('headimgurl');
			$table->string('subscribe_time');
			$table->string('unionid');
			$table->string('remark');
			$table->string('groupid');
	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
