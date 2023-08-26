<?php
namespace App\Imports;

use App\Models\Exam;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class ExcelImport implements IReadFilter{

public function readCell($column, $row, $worksheetName = '')
{
    // Implement the logic to read a cell here
    // You can return true to include the cell in reading or false to exclude it
    return true;
}


    public function model(array $row)
    {
        return new Exam([
            'question' => $row['question'],
            'optionA' => $row['optionA'],
            'optionB' => $row['optionB'],
            'optionC' => $row['optionC'],
            'optionD' => $row['optionD'],
            'optionE' => $row['optionE'],
            'correct' => $row['correct'],
            'year' => $row['year'],
        ]);
    }
}