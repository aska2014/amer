<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEstatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estates', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->dropColumn('special');

            $table->boolean('accepted')->default(false);


            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('ka_user_accounts')->onDelete('CASCADE');

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
            $table->boolean('special')->default(false);

            $table->dropForeign('user_id');

            $table->dropColumn('accepted');
		});
	}

}