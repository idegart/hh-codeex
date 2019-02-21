<?php

namespace App\Console\Commands\Codeex;

use App\Exports\RecordExport;
use App\Record;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Validator;

class Export extends Command
{
    protected $signature = 'codeex:export';

    protected $description = 'Принимает входные данные в виде запроса и выполняет потоковое сохранение записей в CSV файл с последующей передачей его на клиентскую часть';

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

            return;
        }

        $record = new Record($data);
        $rand = str_random();
        $fileName = "record-$rand.csv";

        if (Excel::store(new RecordExport($record), $fileName)) {
            if (Storage::exists($fileName)) {
                $path = Storage::path($fileName);

                $this->output->success('Запись сохранена!');

                $this->info('Путь к файлу: ' . $path);
                $this->info('Ссылка на файл: ' . Storage::url($fileName));

                return;
            }
        }

        $this->warn('Что-то пошло не так');
    }
}
