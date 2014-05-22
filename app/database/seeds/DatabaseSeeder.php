<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$user = new User;
		$user->email = 'waycs16@gmail.com';
		$user->username = 'admin';
		$user->password = Hash::make('way12com');
		$user->confirmation_code = 'asdfsafsdf';
		$user->confirmed = true;
		$user->save();
    $this->command->info('User table seeded!');
	}

}
