<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class Compose extends Command
{
    protected $signature = 'codeex:compose';

    protected $description = 'Принимает входные данные автозаполняет пустые поля сущности';


    public function handle()
    {
        $name = $this->ask('Введите наименование');
        $address = $this->ask('Введите адрес');


        $client = new Client(); //GuzzleHttp\Client
        $result = $client->post(config('dadata.api_link'), [
            'headers'        => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Token ' . config('dadata.api_key'),
            ],
            'body' => json_encode([
                'query' => "$name $address"
            ])
        ]);

        $data = json_decode($result->getBody()->getContents(), true)['suggestions'][0];

        if (! $data) {
            $this->alert('Запись не создана. Предприятие не найдено');
            return;
        }

        $record = Record::create([
            'name' => $data['value'],
            'ogrn' => $data['data']['ogrn'],
            'inn' => $data['data']['inn'],
            'cpp' => $data['data']['ogrn_date'],
            'address' => $data['data']['address']['value'],
            'director' => $data['data']['management']['name'],
        ]);

        $this->output->success('Запись сохранена! ID записи - ' . $record->getKey());
    }
}
