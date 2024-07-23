<?php

namespace SLIM\Abbreviation\App\Imports;


use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use SLIM\Abbreviation\App\Models\Abbreviation;

class AbbreviationImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return  Abbreviation::query()
            ->updateOrCreate(['char_abbreviations'=>$row['abbreviation']],[
            'word_abbreviations' => $row['abbreviation_for'],
            'description_abbreviations' => $row['abbreviation_description'],
            'is_active' => $row['status'] ?? 1,
        ]);

    }


    public function rules(): array
    {
        return [
            'abbreviation' => 'required|string',
            'abbreviation_for' => 'required|string',
            'abbreviation_description' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
        ];
    }
}
