<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('billers')->truncate();
      DB::table('service_categories')->truncate();
      DB::table('admins')->truncate();
      DB::table('biller_services')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      $this->call(ServiceCategorySeeder::class);
      $this->call(AdminSeeder::class);
      $this->call(BillersTableSeeder::class);
      $this->call(BillerServicesSeeder::class);
      // $this->call(UserSeeder::class);
    }
}
