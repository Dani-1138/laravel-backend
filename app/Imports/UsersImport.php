<?php

namespace App\Imports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersImport implements ToModel, WithHeadingRow, WithHeadings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Exam([
            "question" => $row['question'],
            "optionA" => $row['optionA'],
            "optionB" => $row['optionB'],
            "optionC" => $row['optionC'],
            "optionD" => $row['optionD'],
            "optionE" => $row['optionE'],
            "correct" => $row['correct'],
            "year" => 2012,
        ]);
    }
}
