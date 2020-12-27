<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Biller;

class BillersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

    	    'airtime' => [

    	        'billers' => [
    	            ['biller_code' => 'BIL099', 'name' => 'MTN', 'thumbnail_path' => asset('/thumbnails/billers/mtn.jpg')],
    	            ['biller_code' => 'BIL099', 'name' => 'GLO', 'thumbnail_path' => asset('/thumbnails/billers/glo.jpg')],
    	            ['biller_code' => 'BIL099', 'name' => 'AIRTEL', 'thumbnail_path' => asset('/thumbnails/billers/airtel.jpg')],
    	            ['biller_code' => 'BIL099', 'name' => 'ETISALAT', 'thumbnail_path' => asset('/thumbnails/billers/etisalat.jpg')],

    	        ]
    	    ],

    	    'data_bundle' => [

    	        'billers' => [
    	            ['biller_code' => 'BIL108', 'name' => 'MTN', 'thumbnail_path' => asset('/thumbnails/billers/mtn.jpg')],
    	            ['biller_code' => 'BIL109', 'name' => 'GLO', 'thumbnail_path' => asset('/thumbnails/billers/glo.jpg')],
    	            ['biller_code' => 'BIL110', 'name' => 'AIRTEL', 'thumbnail_path' => asset('/thumbnails/billers/airtel.jpg')],
    	            ['biller_code' => 'BIL111', 'name' => 'ETISALAT', 'thumbnail_path' => asset('/thumbnails/billers/etisalat.jpg')],

    	        ]
    	    ],


    	    'electricity' => [

    	        'billers' => [
    	            ['biller_code' => 'BIL112', 'name' => 'EKO ELECTRICITY ', 'thumbnail_path' => asset('/thumbnails/billers/eko.jpg')],
    	            ['biller_code' => 'BIL113', 'name' => 'IKEJA ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/ikeja.jpg')],
    	            ['biller_code' => 'BIL114', 'name' => 'IBADAN ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/ibadan.jpg')],
    	            ['biller_code' => 'BIL115', 'name' => 'ENUGU ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/enugu.jpg')],
    	            ['biller_code' => 'BIL116', 'name' => 'PHC ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/phc.jpg')],
    	            ['biller_code' => 'BIL117', 'name' => 'BENIN ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/benin.jpg')],
    	            ['biller_code' => 'BIL118', 'name' => 'YOLA ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/yola.jpg')],
    	            ['biller_code' => 'BIL120', 'name' => 'KANO ELECTRICITY', 'thumbnail_path' => asset('/thumbnails/billers/kano.jpg')]

    	        ]
    	    ],

    	    'tv_subscription' => [

    	        'billers' => [
    	            ['biller_code' => 'BIL121', 'name' => 'DSTV', 'thumbnail_path' => asset('/thumbnails/billers/mtn.jpg')],
    	            ['biller_code' => 'BIL122', 'name' => 'GOTV', 'thumbnail_path' => asset('/thumbnails/billers/mtn.jpg')],
    	            ['biller_code' => 'BIL123', 'name' => 'STARTIMES', 'thumbnail_path' => asset('/thumbnails/billers/mtn.jpg')]

    	        ]
    	    ],
    	];

    	$collection = collect($categories);

    	$sCategories = ServiceCategory::all();

    	foreach ($sCategories as $category) {

    	    $collection->map(function ($value, $key) use ($category) { 
    	        if ($category->slug == $key ) {

	            	foreach ($value['billers'] as $biller => $value) {
	            		$biller = new Biller();

	            		$biller->create([
	            			'name' => $value['name'],
	            			'biller_code' => $value['biller_code'],
	            			'thumbnail_path' => $value['thumbnail_path'],
	            			'category_id' => $category->id
	            		]);
	            	}
    	        }
    	    });
    	}
    }
}
