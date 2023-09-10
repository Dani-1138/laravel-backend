<?php

namespace App\Imports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\ToModel;

class ExamImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (count($row) >= 7) {
            return new Exam([
                'question' => $row[0],
                'optionA' => $row[1],
                'optionB' => $row[2],
                'optionC' => $row[3],
                'optionD' => $row[4],
                'optionE' => $row[5],
                'correct' => $row[6],
                'year' => 2012,
            ]);
        }
    
        // Handle invalid rows (e.g., log an error or skip the row)
        return null;
    }
}
