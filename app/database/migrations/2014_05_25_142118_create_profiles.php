<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfiles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('title');
			$table->string('about');	
			
			$table->string("cover_file_name")->nullable();
			$table->integer("cover_file_size")->nullable();
			$table->string("cover_content_type")->nullable();
			$table->timestamp("cover_updated_at")->nullable();
			
			$table->string('facebook')->nullable();		
			$table->string('twitter')->nullable();		
			$table->string('line')->nullable();		
			$table->string('email')->nullable();		
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
