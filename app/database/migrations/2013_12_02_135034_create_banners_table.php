<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banners', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id');

            $table->dateTime('from');
            $table->dateTime('to');

            $table->string('url');

            $table->integer('banner_place_id')->unsigned();
            $table->foreign('banner_place_id')->references('id')->on('banner_places')->onDelete('CASCADE');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banners');
	}

}
