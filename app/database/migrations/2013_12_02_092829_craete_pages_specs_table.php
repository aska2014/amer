<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CraetePagesSpecsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('page_specs', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->string('title');
            $table->text('body');

            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('CASCADE');

            $table->string('language', 5);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('page_specs');
	}

}