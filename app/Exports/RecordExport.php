<?php

namespace App\Exports;

use App\Record;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RecordExport implements FromView
{
    /** @var Record */
    protected $record;

    public function __construct(Record $record)
    {
        $this->record = $record;
    }


    public function view(): View
    {
        return view('export.records', [
            'records' => collect([$this->record])
        ]);
    }
}
