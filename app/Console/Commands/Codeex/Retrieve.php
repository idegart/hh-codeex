<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;

class Retrieve extends Command
{
    protected $signature = 'codeex:retrieve {id?}';

    protected $description = 'Выполняет извлечение записи с помощью уникального идентификатора записи';


    public function handle()
    {
        $recordId = $this->argument('id') ?? $this->ask('Введите ID записи');

        $record = Record::find($recordId);

        if (!$record) {
            $this->alert('Запись не найдена');
            return;
        }

        $this->table([
            'ID', 'UID', 'Наименование',
            'ОГРН', 'ИНН', 'КПП',
            'Адрес', 'ФИО руководителя'
        ], [
            [
                $record->getKey(),
                $record->getAttribute('uid'),
                $record->getAttribute('name'),
                $record->getAttribute('ogrn'),
                $record->getAttribute('inn'),
                $record->getAttribute('cpp'),
                $record->getAttribute('address'),
                $record->getAttribute('director'),
            ]
        ]);
    }
}
