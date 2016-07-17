<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userName');
			$table->string('CreateTime');
			$table->text('PicUrl');
			$table->integer('MediaId');
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
