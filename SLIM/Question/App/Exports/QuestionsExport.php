<?php

namespace SLIM\Question\App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuestionsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(public $questions)
    {
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->questions;
    }

    public function map($row): array
    {
        return [
            $row->question,
            $row->specialist->name,
            $row->sub_specialist->name,
            $row->model_answer,
            $row->question_mark,
            $row->description,
            $row->answer_a,
            $row->answer_b,
            $row->answer_c,
            $row->answer_d,
            $this->getLevelText($row->level),
        ];
    }

    public function headings(): array
    {
        return [
            'question',
            'specialization',
            'sub specialization',
            'model answer',
            'question mark',
            'description',
            'answer_a',
            'answer_b',
            'answer_c',
            'answer_d',
            'level',
        ];
    }

    private function getLevelText($level): string
    {
        return match ($level) {
            1 => 'easy',
            2 => 'intermediate',
            3 => 'difficult',
        };
    }
}
