<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->nullable();	
			$table->string('locale', 2);
			$table->string('title');
			$table->text('summary');
			$table->text('content');					
			$table->string('slug')->nullable()->index();
			
			$table->integer('user_id')->unsigned();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
