<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userName');
			$table->string('CreateTime');
			$table->string('Location_X');
			$table->string('Location_Y');
			$table->string('Scale');
			$table->string('Label');
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
