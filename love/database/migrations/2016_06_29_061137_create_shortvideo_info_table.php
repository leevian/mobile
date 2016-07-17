<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortvideoInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shortvideo_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userName');
			$table->string('CreateTime');
			$table->integer('MediaId');
			$table->integer('ThumbMediaId');
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
