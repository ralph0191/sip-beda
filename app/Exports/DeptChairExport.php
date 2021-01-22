<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class DeptChairExport implements WithHeadings, WithEvents, ShouldAutoSize, WithMultipleSheets, WithTitle
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) 
            {
                $courses = Course::all();
                $sheet = $event->sheet;

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '008080'],
                        ],
                    ],
                    'font' => [
                        'name' => 'arial',
                        'size' => 14,
                        'bold' => true
                    ]
                ];
                $sheet->getCell('A2')->setValue("Juan");
                $sheet->getCell('B2')->setValue("Luna");
                $sheet->getCell('C2')->setValue("Dela Cruz");
                $sheet->getCell('D2')->setValue("1991-01-22");
                $sheet->getCell('E2')->setValue("juan.delacruz@company.com");
                $sheet->getCell('F2')->setValue("Bachelor of Elementary Education");
                $sheet->getCell('G2')->setValue("123213213");
                $cellRange = 'A1:H1'; // All headers
                $sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                for ($index = 2; $index < 1000; $index++) {
                    $sheet->getCell('F' . $index)->getDataValidation()->setType(DataValidation::TYPE_LIST);
                    $sheet->getCell('F' . $index)->getDataValidation()->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $sheet->getCell('F' . $index)->getDataValidation()->setAllowBlank(false);
                    $sheet->getCell('F' . $index)->getDataValidation()->setShowInputMessage(true);
                    $sheet->getCell('F' . $index)->getDataValidation()->setShowErrorMessage(true);
                    $sheet->getCell('F' . $index)->getDataValidation()->setShowDropDown(true);
                    $sheet->getCell('F' . $index)->getDataValidation()->setErrorTitle('Input error');
                    $sheet->getCell('F' . $index)->getDataValidation()->setError('Value is not in list.');
                    $sheet->getCell('F' . $index)->getDataValidation()->setPromptTitle('Pick from list');
                    $sheet->getCell('F' . $index)->getDataValidation()->setPrompt('Please pick a value from the drop-down list.');
                    $sheet->getCell('F' . $index)->getDataValidation()->setFormula1('=\'Courses\'!$A$1:$A$'. $courses->count());
                }
            }
        ];
    }

    public function title(): string
    {
        return 'Import Dept-Chairs';
    }
}
