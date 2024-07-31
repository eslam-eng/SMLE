<?php

namespace SLIM\Question\App\Exports\sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use SLIM\Subspecialties\App\Models\SubSpecialties;

class SubSpecialistsExportSheet implements FromQuery, WithEvents, withHeadings, WithMapping, WithTitle
{
    use RegistersEventListeners;


    public function title(): string
    {
        return 'sub-specialists';
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
        ];
    }

    public function query()
    {
        return SubSpecialties::query();
    }
}
