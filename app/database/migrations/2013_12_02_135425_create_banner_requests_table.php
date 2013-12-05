<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banner_requests', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id');

            $table->string('description');

            $table->integer('banner_place_id')->unsigned();
            $table->foreign('banner_place_id')->references('id')->on('banner_places')->onDelete('CASCADE');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('ka_user_accounts')->onDelete('CASCADE');

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
		Schema::drop('banner_requests');
	}

}
