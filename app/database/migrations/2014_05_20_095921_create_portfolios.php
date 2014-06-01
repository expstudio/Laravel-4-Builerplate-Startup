<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolios', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('customer')->nullable();
			$table->string('preview_path')->nullable();
			$table->string('site_url')->nullable();
			$table->text('content');
			$table->text('tags')->nullable();
			
			$table->string("cover_file_name")->nullable();
			$table->integer("cover_file_size")->nullable();
			$table->string("cover_content_type")->nullable();
			$table->timestamp("cover_updated_at")->nullable();
			
			$table->string("desktop_file_name")->nullable();
			$table->integer("desktop_file_size")->nullable();
			$table->string("desktop_content_type")->nullable();
			$table->timestamp("desktop_updated_at")->nullable();
			
			$table->string("tablet_file_name")->nullable();
			$table->integer("tablet_file_size")->nullable();
			$table->string("tablet_content_type")->nullable();
			$table->timestamp("tablet_updated_at")->nullable();
			
			$table->string("mobile_file_name")->nullable();
			$table->integer("mobile_file_size")->nullable();
			$table->string("mobile_content_type")->nullable();
			$table->timestamp("mobile_updated_at")->nullable();
			
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
