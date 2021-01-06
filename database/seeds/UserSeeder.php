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
            // Note: The user password is 'password'
            $user = array_merge($user, ['password' => '$2y$10$T5eBbew0IBI66OJ4zrYXU.4ZphiN7gzJyuSp3SSYwJQl0hbM1.wxm']);
	        $userR = App\User::create($user);
            
            $userR->wallet()->create([
            'unique_address' => generateWalletId(),
            'credit' => 0,
            'debit' => 0,
            'balance' => 0
        ]);
	    }
    }
}
