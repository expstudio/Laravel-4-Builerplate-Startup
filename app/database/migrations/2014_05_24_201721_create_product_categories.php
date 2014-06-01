<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('name_en');
			$table->string('name_th');
			$table->string('slug')->nullable();
			
			$table->string("image_file_name")->nullable();
			$table->integer("image_file_size")->nullable();
			$table->string("image_content_type")->nullable();
			$table->timestamp("image_updated_at")->nullable();

			$table->integer('product_category_id')->unsigned()->index();

			$table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
