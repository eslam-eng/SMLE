<?php

namespace SLIM\Question\App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use SLIM\Question\App\Exports\sheets\QuestionTemplateExportSheet;
use SLIM\Question\App\Exports\sheets\SpecialistsExportSheet;
use SLIM\Question\App\Exports\sheets\SubSpecialistsExportSheet;

class QuestionEmptyTemplate implements WithEvents, WithMultipleSheets
{
    use Exportable, RegistersEventListeners;

    public function __construct() {}

    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new QuestionTemplateExportSheet();
        $sheets[1] = new SpecialistsExportSheet();
        $sheets[2] = new SubSpecialistsExportSheet();
        return $sheets;
    }


}
