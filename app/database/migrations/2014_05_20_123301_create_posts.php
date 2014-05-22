<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('summary')->nullable();
			$table->text('content');		
			
			$table->string("cover_file_name")->nullable();
			$table->integer("cover_file_size")->nullable();
			$table->string("cover_content_type")->nullable();
			$table->timestamp("cover_updated_at")->nullable();
			
			$table->string('tags')->nullable();			
			$table->text("style")->nullable();			
			$table->string("post_type", 20)->default('post');	
			$table->string("post_status", 20)->default('publish');	
			$table->string("comment_status", 20)->default('open');	
			$table->string('slug')->nullable()->index();
			$table->integer("comments_count")->default(0);	
			
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
