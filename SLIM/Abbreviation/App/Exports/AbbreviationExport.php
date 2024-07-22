<?php

namespace SLIM\Abbreviation\App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbbreviationExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(public $abbreviations)
    {
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->abbreviations;
    }

    public function map($row): array
    {
        return [
            $row->char_abbreviations,
            $row->word_abbreviations,
            $row->description_abbreviations,
            $row->is_active,
        ];
    }

    public function headings(): array
    {
        return [
            'abbreviation',
            'abbreviation for',
            'abbreviation description',
            'status',
        ];
    }
}
