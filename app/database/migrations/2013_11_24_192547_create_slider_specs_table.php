<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderSpecsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider_specs', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id');

            $table->string('title');

            $table->text('large_description');
            $table->text('small_description');

            $table->integer('slider_id')->unsigned();
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('CASCADE');

            $table->string('language');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('slider_specs');
	}

}
