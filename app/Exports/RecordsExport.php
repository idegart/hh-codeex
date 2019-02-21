<?php

namespace App\Exports;

use App\Record;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class RecordsExport implements FromView
{
    public function view(): View
    {
        return view('export.records', [
            'records' => Record::all()
        ]);
    }
}
