<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBackTwitterIdToFollows extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('follows', function(Blueprint $table)
		{
			$table->string('twitter_id')->nullable();
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
			$table->dropColumn('twitter_id');
		});
	}

}
