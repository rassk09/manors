<?php

namespace App\Console\Commands;

use App\Models\Manor;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GetGeo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:geo';

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
        $manors = Manor::whereNotIn('id', [56, 57, 58, 113])->get();

        foreach ($manors as $manor) {
            $client = new Client;

            $params = [
                'apikey' => '66502966-277a-449d-bbfc-1d82323b26ce',
                'format' => 'json',
                'geocode' => $manor->address
            ];

            $this->info($manor->id);

            try {
                $response = $client->post('https://geocode-maps.yandex.ru/1.x/', [
                    'form_params' => $params,
                ]);

                $content = json_decode($response->getBody()->getContents(), true);

                file_put_contents(storage_path() . '/yandex2.txt', '====' . $manor->id . '====' . chr(10), FILE_APPEND);
                file_put_contents(storage_path() . '/yandex2.txt', var_export($content, true), FILE_APPEND);

                $point = explode(' ', $content['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);
                $manor->geo_lat = $point[1];
                $manor->geo_lng = $point[0];
                $manor->save();

            } catch (\Exception $e) {
                dd($e);
            }


        }
        
    }
}
