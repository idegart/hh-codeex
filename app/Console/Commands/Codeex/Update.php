<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;

class Update extends Command
{
    protected $signature = 'codeex:update {id?}';

    protected $description = 'Принимает входные данные и выполняет обновление существующей записи в хранилище с данными с помощью уникального идентификатора записи';


    public function handle()
    {
        $recordId = $this->argument('id') ?? $this->ask('Введите ID записи');

        $record = Record::find($recordId);

        if (!$record) {
            $this->alert('Запись не найдена');
            return;
        }

        if ($name = $this->ask('Введите наименование')) {
            $record->setAttribute('name', $name);
        }

        if ($ogrn = $this->ask('Введите ОГРН')) {
            $record->setAttribute('ogrn', $ogrn);
        }

        if ($inn = $this->ask('Введите ИНН')) {
            $record->setAttribute('inn', $inn);
        }

        if ($cpp = $this->ask('Введите КПП')) {
            $record->setAttribute('cpp', $cpp);
        }

        if ($address = $this->ask('Введите адрес')) {
            $record->setAttribute('address', $address);
        }

        if ($director = $this->ask('Введите ФИО Руководителя')) {
            $record->setAttribute('director', $director);
        }

        $record->save();

        $this->output->success('Запись обновлена');
    }
}
