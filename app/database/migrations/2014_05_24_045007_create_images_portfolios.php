<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesPortfolios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images_portfolios', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');	
			$table->integer('portfolio_id')->unsigned()->index();
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');		
			$table->integer("order")->nullable();	
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
