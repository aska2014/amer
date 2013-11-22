<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUserInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ka_user_info', function(Blueprint $table)
		{
            $table->string('telephone_number');

            $table->string('mobile_number');

            $table->string('contact_email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ka_user_info', function(Blueprint $table)
		{
            $table->dropColumn('telephone_number', 'mobile_number', 'contact_email');
		});
	}

}