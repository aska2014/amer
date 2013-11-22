<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // This table define user accounts
		Schema::create('ka_user_accounts', function(Blueprint $table)
		{
			$table->increments('id');

            // Email and password are required to create an account
            $table->string('email')->unique();
            $table->string('password');

            // The username can be null
            $table->string('username')->nullable()->unique();

            $table->smallInteger('type')->default(Kareem3d\Membership\User::NORMAL);

            $table->dateTime('online_at');

            $table->integer('user_info_id')->unsigned();
            $table->foreign('user_info_id')->references('id')->on('ka_user_info')->onDelete('CASCADE');

            $table->softDeletes();
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
		Schema::drop('ka_user_accounts');
	}

}
