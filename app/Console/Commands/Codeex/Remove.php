<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;

class Remove extends Command
{
    protected $signature = 'codeex:remove {id?}';

    protected $description = 'Принимает входные данные и выполняет логическое удаление существующей записи в хранилище с данными с помощью уникального идентификатора записи с заполнением свойства date_removed';


    public function handle()
    {
        $recordId = $this->argument('id') ?? $this->ask('Введите ID записи');

        $record = Record::find($recordId);

        if (!$record) {
            $this->alert('Запись не найдена');
            return;
        }

        if (! $this->confirm('Вы уверены что хотите удалить запись?')) {
            $this->alert('Запись оставлена');
            return;
        }

        $record->delete();
        $this->alert('Запись удалена');
    }
}
