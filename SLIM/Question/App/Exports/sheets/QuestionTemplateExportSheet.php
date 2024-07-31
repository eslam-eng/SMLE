<?php

namespace SLIM\Question\App\Exports\sheets;

use App\Services\Tenant\CrudServices\TypeService;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class QuestionTemplateExportSheet implements WithEvents, withHeadings, WithTitle
{
    use RegistersEventListeners;


    public function title(): string
    {
        return 'questions';
    }

    public function headings(): array
    {
        return [
            'id',
            'question',
            'specialist_id',
            'sub_specialist_id',
            'model_answer',
            'question_mark',
            'answer_a',
            'answer_b',
            'answer_c',
            'answer_d',
            'level',
            'description'
        ];
    }

}
