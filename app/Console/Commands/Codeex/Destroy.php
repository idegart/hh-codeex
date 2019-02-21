<?php

namespace App\Console\Commands\Codeex;

use App\Record;
use Illuminate\Console\Command;

class Destroy extends Command
{
    protected $signature = 'codeex:destroy {id?}';

    protected $description = 'Выполняет фактическое удаление записи в хранилище с данными с помощью уникального идентификатора записи';


    public function handle()
    {
        $recordId = $this->argument('id') ?? $this->ask('Введите ID записи');

        $record = Record::query()->where('id', $recordId)->withTrashed()->first();

        if (!$record) {
            $this->alert('Запись не найдена');
            return;
        }

        if (! $this->confirm('Вы уверены что хотите удалить запись?')) {
            $this->alert('Запись оставлена');
            return;
        }

        $record->forceDelete();

        $this->output->success('Запись удалена!');
    }
}
