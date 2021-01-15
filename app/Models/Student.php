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
        'user_id','first_name','middle_name','last_name','email', 'course_id',
        'student_number', 'birthday','address','mobile_number','picture'
    ];
    
    protected $table = 'students';

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function course() {
        return $this->hasOne(Course::class, 'course_id');
    }

    public function studentProgress() {
        return $this->hasOne(StudentProgress::class,'user_id');
    }
}
