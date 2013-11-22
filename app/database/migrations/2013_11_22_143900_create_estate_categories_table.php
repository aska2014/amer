<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estate_categories', function(Blueprint $table)
		{
			$table->increments('id');

            // Parent categroy
            $table->integer('estate_category_id')->unsigned()->nullable();
            $table->foreign('estate_category_id')->references('id')->on('estate_categories')->onDelete('CASCADE');

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
		Schema::drop('estate_categories');
	}

}
