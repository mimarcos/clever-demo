<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// starting
		$this->command->info('Beginning database seeding...');

		// call seeders
		$this->call('TestTableSeeder');
		
		// finished
		$this->command->info('... seeding complete!');
	}

}
