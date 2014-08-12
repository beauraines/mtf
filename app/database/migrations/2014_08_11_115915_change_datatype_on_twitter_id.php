<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDatatypeOnTwitterId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('follows', function(Blueprint $table)
		{
			$table->renameColumn('twitter_id','twitter_id_int');
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
		        $table->renameColumn('twitter_id_int','twitter_id');
		});
	}

}
