<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;
use Validator;

class Create extends Command
{
    protected $signature = 'codeex:create';

    protected $description = 'Выполняет сохранение в хранилище с данными';


    public function handle()
    {
        $name = $this->ask('Введите наименование');
        $ogrn = $this->ask('Введите ОГРН');
        $inn = $this->ask('Введите ИНН');
        $cpp = $this->ask('Введите КПП');
        $address = $this->ask('Введите адрес');
        $director = $this->ask('Введите ФИО Руководителя');

        $data = [
            'name' => $name,
            'ogrn' => $ogrn,
            'inn' => $inn,
            'cpp' => $cpp,
            'address' => $address,
            'director' => $director
        ];

        $validator = Validator::make($data, [
            'name' => [
                'required', 'string', 'max:128'
            ],
            'ogrn' => [
                'required', 'string', 'max:128'
            ],
            'inn' => [
                'required', 'string', 'max:128'
            ],
            'cpp' => [
                'required', 'string', 'max:128'
            ],
            'address' => [
                'required', 'string', 'max:128'
            ],
            'director' => [
                'required', 'string', 'max:128'
            ]
        ], [
            'name.required' => 'Необходимо ввести название',
            'ogrn.required' => 'Необходимо ввести ОГРН',
            'inn.required' => 'Необходимо ввести ИНН',
            'cpp.required' => 'Необходимо ввести КПП',
            'address.required' => 'Необходимо ввести адрес',
            'director.required' => 'Необходимо ввести ФИО руководителя',
        ]);

        if ($validator->fails()) {
            $this->alert('Запись не создана. Исправьте следующие ошибки:');

            foreach ($validator->errors()->all() as $error) {
                $this->warn($error);
            }
        }

        $record = Record::create($data);

        $this->info('Запись сохранена! ID записи - ' . $record->getKey());
    }
}
