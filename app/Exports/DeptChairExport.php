<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class DeptChairExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithMultipleSheets, WithTitle
{

    public function headings(): array
    {
        return [
            'first_name',
            'middle_name',
            'last_name',
            'birth_date',
            'email',
            'course',
            'employee_number',
        ];
    }

    public function sheets(): array 
    {
        $sheets = [];
        $sheets[] = new DeptChairExport;
        $sheets[] = new CoursesExport;
        return $sheets;
    }

    public function title(): string
    {
        return 'Import Dept-Chairs';
    }
}
