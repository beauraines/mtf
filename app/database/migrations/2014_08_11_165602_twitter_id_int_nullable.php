<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TwitterIdIntNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('follows', function(Blueprint $table)
		{
			$table->dropColumn('twitter_id_int');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('follows', function(Blueprint $table)
		{
			$table->addColumn('twitter_id_int')->nullable();
		});
	}

}
