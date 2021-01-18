<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected $table = 'courses';

    public function student() {
        return $this->hasOne(Student::class, 'id');
    }

    public function deptChair() {
        return $this->hasOne(DeptChair::class, 'id');
    }
}
