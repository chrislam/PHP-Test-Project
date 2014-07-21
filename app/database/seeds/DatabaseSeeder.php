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

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run()
	{
		DB::table('users')->delete();

    User::create(
			array(
					'first_name' => 'Chris',
					'last_name' => 'Lam',
					'email' => 'chris@lam.co.nz',
					'password' => Hash::make('2trees88'),
					'group' => 'A',
					'is_active' => True
			)
		);

		User::create(
			array(
					'first_name' => 'Tarryn',
					'last_name' => 'Buttery',
					'email' => 'tarryn@lam.co.nz',
					'password' => Hash::make('tazzDevil09'),
					'group' => 'A',
					'is_active' => True
			)
		);

		User::create(
			array(
					'first_name' => 'Ken',
					'last_name' => 'Vu',
					'email' => 'ken@gladeye.co.nz',
					'password' => Hash::make('ken'),
					'group' => 'U',
					'is_active' => True
			)
		);

		User::create(
			array(
					'first_name' => 'Michael',
					'last_name' => 'Andrew',
					'email' => 'michael@gladeye.co.nz',
					'password' => Hash::make('michael'),
					'group' => 'U',
					'is_active' => True
			)
		);
	}
}
