<?php

use Illuminate\Database\Seeder;
use App\Models\NigeriaState;

class NigeriaStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
					  "Abia",
					  "Adamawa",
					  "Akwa Ibom",
					  "Anambra",
					  "Bauchi",
					  "Bayelsa",
					  "Benue",
					  "Borno",
					  "Cross River",
					  "Delta",
					  "Ebonyi",
					  "Edo",
					  "Ekiti",
					  "Enugu",
					  "FCT - Abuja",
					  "Gombe",
					  "Imo",
					  "Jigawa",
					  "Kaduna",
					  "Kano",
					  "Katsina",
					  "Kebbi",
					  "Kogi",
					  "Kwara",
					  "Lagos",
					  "Nasarawa",
					  "Niger",
					  "Ogun",
					  "Ondo",
					  "Osun",
					  "Oyo",
					  "Plateau",
					  "Rivers",
					  "Sokoto",
					  "Taraba",
					  "Yobe",
					  "Zamfara"
				];
        NigeriaState::truncate();

        for ($i=0; $i < count($states); $i++) { 
        	$insert = new NigeriaState();
        	$insert->name = $states[$i];
        	$insert->save();
        }


    }
}
