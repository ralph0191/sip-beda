<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
    
    protected $table = 'courses';

    public function student() {
        return $this->belongsTo(User::class,'user_id');
    }
}
