<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternshipRequirements;

class InternshipRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InternshipRequirements::insert([
            [
                'desc' => 'Notice of Intent Form (processed one semester before the scheduled internship)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Request for Endorsement Form',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Resume – 2 copies (1 for school file and 1 for the company, follow the given format)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Internship Expectations Essay (1 page, computerized, printed on a short bond paper, Arial Font, size 12 and 1.5 line spacing)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Photocopy of grades (school file)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Photocopy of Birth Certificate (1 for company and 1 for school file)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Medical Certificate (Indicating that students is in good health and emotionally fit. The Medical certificate shall be based on a physical and psychological examination conducted, or certified by the Department of Health (DOH) accredited clinics and hospitals.)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Internship Agreement Form (signed by parents)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Notarized Written Consent Letter from Parent or Legal Guardian',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Photocopy of COR/Add Drop Registration Form (proof that one is enrolled in the Internship Program in the present semester)',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Attendance in the SIP Orientation and Seminar',
                'file_url' => '',
                'internship_type' => 0
            ],
            [
                'desc' => 'Certificate of Acceptance in the Company(Signed by the HR Manager and Supervisor)',
                'file_url' => '',
                'internship_type' => 1
            ],
            [
                'desc' => 'Intern\'s Official Schedule (Signed by the HR Manager, Supervisor, Teacher-in-Charge and Department Chairperson)',
                'file_url' => '',
                'internship_type' => 1
            ],
            [
                'desc' => 'Weekly Internship Report (student interns will be given 1 copy, they will photocopy 10-12 copies of the form for their weekly reports; 400 hours = 10-12 weeks. Students will accomplish the form and have their supervisor and teacher-in-charge sign the form every end of the week. They will compile the forms and submit to the Sip office at the end of their internship together with the Internship Completion Report)',
                'file_url' => '',
                'internship_type' => 1
            ],
            [
                'desc' => 'Supervisor\'s Evaluation of Student Internship Performance (sealed in an envelope with supervisors\'s signature on the flap)',
                'file_url' => '',
                'internship_type' => 2
            ],
            [
                'desc' => 'Certificate of Completion (given by the company, proof that the intern has finished the required hours)',
                'file_url' => '',
                'internship_type' => 2
            ],
            [
                'desc' => 'Internship Completion Report and Reflection (SIP Form and separate paper filed in a short ordinary folder computerized, printed on a short bond paper, Arial font, size 12  and 1.5 line spacing)',
                'file_url' => '',
                'internship_type' => 2
            ],
        ]);
    }
}
