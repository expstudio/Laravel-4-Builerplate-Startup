<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id')->nullable();	
			$table->string('locale', 2);
			$table->string('title');
			$table->text('content');					
			$table->string('slug')->nullable()->index();
			
			$table->integer('user_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
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
