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

            $table->boolean('accepted')->default(false);

            $table->integer('user_id')->unsigned()->nullable();
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
            $table->dropForeign('user_id');

            $table->dropColumn('accepted');
		});
	}

}