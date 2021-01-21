<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id','course_id','student_number',
        'ojt_status'
    ];
    
    protected $table = 'students';

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function studentProgress() {
        return $this->hasOne(StudentProgress::class,'id');
    }

    public function internshipData() {
        return $this->hasMany(internshipData::class, 'id');
    }
}
