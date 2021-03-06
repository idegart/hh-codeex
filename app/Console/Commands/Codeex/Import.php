<?php

namespace App\Console\Commands\Codeex;

use App\Imports\RecordImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class Import extends Command
{
    protected $signature = 'codeex:import {path?}';

    protected $description = 'Принимает входные данные в виде CSV файла, выполняет потоковую валидацию файла и производит сохранение в хранилище с данными';


    public function handle()
    {
        $this->info('Документ должен иметь вид: Наименование/ОГРН/ИНН/КПП/Адрес/Руководитель');

        $filePath = trim($this->argument('path') ?? $this->ask('Введите путь к файлу'));

        if (! file_exists($filePath)) {
            $this->warn('Документ не найден!');
            return;
        }

        try {

            $this->output->title('Start import');

            (new RecordImport)->withOutput($this->output)->import($filePath, null, Excel::CSV);

        } catch (ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                foreach ($failure->errors() as $error) {
                    $this->warn('Строка: ' . $failure->row() . '; Атрибут: ' . $failure->attribute() . '; Error: ' . $error);
                }
            }

            return;
        }


        $this->output->success('Import successful');
    }
}
