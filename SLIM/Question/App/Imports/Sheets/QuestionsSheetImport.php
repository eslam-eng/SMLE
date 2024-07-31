<?php

namespace SLIM\Question\App\Imports\Sheets;


use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithValidation;
use SLIM\Question\App\Models\Question;

class QuestionsSheetImport implements ToArray, WithHeadingRow, WithValidation, SkipsEmptyRows, WithLimit
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function array(array $row)
    {
        $insertedData = [];
        foreach ($row as $question) {
            $insertedData[] = [
                'id' => $question['id'] ?: null,
                'question' => $question['question'],
                'specialist_id' => $question['specialist_id'],
                'sub_specialist_id' => $question['sub_specialist_id'],
                'model_answer' => $question['model_answer'],
                'question_mark' => $question['question_mark'],
                'answer_a' => $question['answer_a'],
                'answer_b' => $question['answer_b'],
                'answer_c' => $question['answer_c'],
                'answer_d' => $question['answer_d'],
                'level' => $question['level'],
                'description' => $question['description'],
            ];
        }
        Question::query()->upsert($insertedData, ['id']);
    }


    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'specialist_id' => 'required|exists:specializations,id',
            'sub_specialist_id' => 'required|exists:sub_specialties,id',
            'model_answer' => 'required|string',
            'question_mark' => 'required|numeric|min:0',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'level' => 'required|integer|in:1,2,3',
        ];
    }

    public function limit(): int
    {
        return 1000;
    }
}
