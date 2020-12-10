<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::truncate();

        $admin = new Admin();
        $admin->user_id = 100000;
        $admin->firstname = 'John'; 
        $admin->lastname = 'Doe'; 
        $admin->phone_number = '09080090012'; 
        $admin->email = 'admin@gmail.com'; 
        $admin->email_verified_at = now(); 
        $admin->password = Hash::make('password'); 
        $admin->save();

    }
}
