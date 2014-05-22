<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('content');	
			
			$table->string("cover_file_name")->nullable();
			$table->integer("cover_file_size")->nullable();
			$table->string("cover_content_type")->nullable();
			$table->timestamp("cover_updated_at")->nullable();
			
			$table->string('tags')->nullable();			
			$table->text("style")->nullable();			
			$table->integer('parent_id')->nullable();		
			$table->string('slug')->nullable()->index();
			
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
