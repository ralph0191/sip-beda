<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id','read_form','pre_internship_progress', 'during_internship_progress','end_internship_progress'
    ];
    
    protected $table = 'student_progress';

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
