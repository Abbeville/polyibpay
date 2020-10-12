<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class SpoolBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spool:bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('rave.secretKey')
            ],
        ]);
        $url = "https://api.flutterwave.com/v3/bill-categories";
        $request = $client->get($url);
        $response = $request->getBody()->getContents();
        $response = json_decode($response);

//        $response =  json_encode($response);

       // dd(count($response->data));

        $bar = $this->output->createProgressBar(count($response->data));

        if ($response->status === 'success') {
            $bills = $response->data;
            foreach ($bills as $bill) {
                if ($bill->country === 'NG') {
                    $newService = new Service();
                    $newService->name = $bill->name;
                    $newService->fee = $bill->fee;
                    $newService->amount = $bill->amount;
                    $newService->required_label = $bill->label_name;
                    $newService->item_code = $bill->item_code;
                    $newService->short_name = $bill->short_name;
                    $newService->biller_name = $bill->biller_name;
                    $newService->category_id = 1;
                    $newService->meta_data = serialize($response);
                    $newService->save();
                    $bar->advance();
                }
            }
            $bar->finish();
        }
    }
}
