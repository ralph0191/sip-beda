<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sip extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id','first_name','middle_name','last_name','email','birthday',
        'student_num','address','mobile_number','picture', 'course_id'
    ];

    protected $table = 'sip';
    
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
