<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('specials', function(Blueprint $table)
		{
			$table->increments('id');

            $table->dateTime('from');
            $table->dateTime('to');

            $table->integer('estate_id')->unsigned();
            $table->foreign('estate_id')->references('id')->on('estates')->onDelete('CASCADE');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('specials');
	}

}
