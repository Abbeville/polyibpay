<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(ServiceCategorySeeder::class);
      $this->call(AdminSeeder::class);
      $this->call(BankNameTableSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(NigeriaStatesTableSeeder::class);
    }
}
