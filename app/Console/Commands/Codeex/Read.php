<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;

class Read extends Command
{
    protected $signature = 'codeex:read';

    protected $description = 'Выполняет чтение записей из хранилища с данными';


    public function handle()
    {
        $records = Record::all();

        $formattedRecords = $records->map(function (Record $record) {
            return [
                $record->getKey(),
                $record->getAttribute('uid'),
                $record->getAttribute('name'),
                $record->getAttribute('ogrn'),
                $record->getAttribute('inn'),
                $record->getAttribute('cpp'),
                $record->getAttribute('address'),
                $record->getAttribute('director'),
            ];
        });

        $this->info('Список записаных предприятий:');

        $this->table([
            'ID', 'UID', 'Наименование',
            'ОГРН', 'ИНН', 'КПП',
            'Адрес', 'ФИО руководителя'
        ], $formattedRecords->toArray());
    }
}
