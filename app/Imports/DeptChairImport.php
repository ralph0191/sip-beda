<?php

namespace App\Imports;

use App\Models\DeptChair;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Status;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DeptChairImport implements  WithHeadingRow, WithMapping, WithMultipleSheets,
WithValidation, ToCollection 
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {

            $user = User::create([
                'first_name'            => $row['first_name'],
                'middle_name'           => $row['middle_name'],
                'last_name'             => $row['last_name'],
                'email'                 => $row['email'],
                'birthday'              => $row['birth_date'],
                'password'              => Hash::make('password'),
                'role_id'               => 2
            ]);

            $user->deptChair()->create([
                'user_id'                => $user->id,
                'employee_number'        => $row['employee_number'],
                'course_id'              => $row['course']
            ]);
        }
    }

    public function map($row): array
    {
        if(gettype($row['birth_date']) == 'integer'){            
            $row['birth_date'] = Carbon::parse(Date::excelToDateTimeObject($row['birth_date']))->format('Y-m-d'); 
        }
        
        $courseId = Course::where('name', $row['course'])->first();
        $row['course'] = $courseId->id;
        
        return $row;
    }

    public function sheets(): array 
    {        
        return [
            0 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            'first_name'                => 'required|string|max:255',
            'middle_name'               => 'required|string|max:255',
            'last_name'                 => 'required|string|max:255',
            'birth_date'                => 'required|nullable|date_format:Y-m-d',
            'email'                     => 'required|string|unique:users',
            'employee_number'           => 'required|unique:dept_chair'
        ];
    }
}
