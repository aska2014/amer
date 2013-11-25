<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estates', function(Blueprint $table)
		{
			$table->increments('id');

            $table->smallInteger('number_of_rooms');

            // This will be null in case of auction
            $table->float('price')->nullable();

            $table->float('area');

            $table->boolean('special');

            $table->integer('owner_info_id')->unsigned();
            $table->foreign('owner_info_id')->references('id')->on('ka_user_info')->onDelete('CASCADE');

            $table->integer('estate_category_id')->unsigned();
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
		Schema::drop('estates');
	}

}
