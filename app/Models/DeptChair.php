<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class DeptChair extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id','first_name','middle_name','last_name','email','birthday',
        'student_num','address','mobile_number','picture', 'course_id'
    ];

    protected $table = 'dept_chair';
    
    public function user() {
        return $this->hasOne(User::class, 'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
