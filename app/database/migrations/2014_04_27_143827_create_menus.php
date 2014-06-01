<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('title_en');
			$table->string('path');
			$table->string('script');
			$table->integer('ordering')->default(99999);
			$table->integer('menu_id')->default(0)->unsigned()->index();
			$table->foreign('menu_id')->references('id')->on('categories')->onDelete('cascade');
			
			$table->integer('user_id')->unsigned();
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
