<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('link_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userName');
			$table->string('CreateTime');
			$table->string('Title');
			$table->string('Discription');
			$table->string('Url');
			$table->integer('MsgId');

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
