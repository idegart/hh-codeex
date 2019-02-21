<?php

namespace App\Imports;

use App\Record;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class RecordImport implements ToModel, WithValidation, WithHeadingRow, WithProgressBar
{
    use Importable;

    public function model(array $row)
    {
        HeadingRowFormatter::default('none');

        return new Record([
            'name' => $row['naimenovanie'],
            'ogrn' => $row['ogrn'],
            'inn' => $row['inn'],
            'cpp' => $row['kpp'],
            'address' => $row['adres'],
            'director' => $row['rukovoditel'],
        ]);
    }


    public function rules(): array
    {
        return [
            'naimenovanie' => ['required', 'string'],
            'ogrn' => ['required', 'string'],
            'inn' => ['required', 'string'],
            'kpp' => ['required', 'string'],
            'adres' => ['required', 'string'],
            'rukovoditel' => ['required', 'string'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'required' => 'Поле :attribute обязательно',
        ];
    }

}
