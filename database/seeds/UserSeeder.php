<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 10)->make()->toArray();

	    foreach ($users as $user) {
	        App\User::create($user);
	    }
    }
}
