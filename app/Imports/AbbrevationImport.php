<?php

namespace App\Imports;

use App\Models\Abbreviation;
use Maatwebsite\Excel\Concerns\ToModel;

class AbbrevationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Abbreviation([
            //
        ]);
    }
}
