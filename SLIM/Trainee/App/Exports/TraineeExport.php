<?php

namespace SLIM\Trainee\App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TraineeExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(public $trainees)
    {
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->trainees;
    }

    public function map($row): array
    {
        return [
            $row->full_name,
            $row->email,
            $row->phone,
            $row->degree,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'phone',
            'educational degree',
        ];
    }
}
