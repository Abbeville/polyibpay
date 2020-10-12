<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Airtime', 'parent' => '','slug' => 'airtime','font_awesome_class' => '', 'thumbnail' => ''],
            ['name' => 'Data Bundle', 'parent' => '','slug' => 'data_bundle','font_awesome_class' => '', 'thumbnail' => ''],
            ['name' => 'Electricity', 'parent' => '','slug' => 'electricity','font_awesome_class' => '', 'thumbnail' => ''],
            ['name' => 'TV Subscription', 'parent' => '','slug' => 'tv_subscription','font_awesome_class' => '', 'thumbnail' => ''],
        ];
        DB::table('service_categories')->insert($data);
    }
}
