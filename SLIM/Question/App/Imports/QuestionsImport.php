<?php

namespace SLIM\Question\App\Imports;


use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use SLIM\Question\App\Imports\Sheets\QuestionsSheetImport;

class QuestionsImport implements WithMultipleSheets
{
    use Importable;

    public function sheets(): array
    {
        return [
            new QuestionsSheetImport()
        ];
    }
}
