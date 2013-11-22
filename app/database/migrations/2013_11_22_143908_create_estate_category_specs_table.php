<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstateCategorySpecsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estate_category_specs', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('title');

            $table->integer('estate_category_id')->unsigned();
            $table->foreign('estate_category_id')->references('id')->on('estate_categories')->onDelete('CASCADE');

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
		Schema::drop('estate_category_specs');
	}

}
