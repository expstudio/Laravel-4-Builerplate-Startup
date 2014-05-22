<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->unsigned()->index();	
			$table->string('author');
			$table->string('author_email');
			$table->string('author_url');
			$table->string('author_ip');
			$table->text('content');			
			
			$table->string('approved', 20)->default(1);
			$table->string('agent')->nullable();
			$table->integer('comment_id')->unsigned();
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
