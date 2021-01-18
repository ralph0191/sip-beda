<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternshipData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id','internship_requirement_id','file_url',
        'remarks','status','internship_type'
    ];

    protected $table = 'internship_data';

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function internshipRequirements() {
        return $this->belongsTo(InternshipRequirements::class, 'student_id');
    }

}
