<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitorsToEstate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estates', function(Blueprint $table)
		{
            $table->integer('number_of_views');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estates', function(Blueprint $table)
		{
            $table->dropColumn('number_of_views');
		});
	}

}