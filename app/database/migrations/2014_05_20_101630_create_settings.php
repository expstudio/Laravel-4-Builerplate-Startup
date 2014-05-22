<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('site_title');
			$table->string('site_name');
			$table->string('site_meta');
			$table->string('site_keyword');
			$table->string('copy_right');
			$table->string('app_key')->nullable();
			$table->string('app_secret')->nullable();
			$table->string('page_id')->nullable();
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
		//
	}

}
