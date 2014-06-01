<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTranslations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolio_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('portfolio_id')->nullable();	
			$table->string('locale', 2);
			$table->string('title');
			$table->string('customer')->nullable();
			$table->text('content');					
			$table->string('slug')->nullable()->index();
			
			$table->integer('user_id')->unsigned();
			$table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
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
