<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternshipRequirements extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'desc', 'file_url', 'internship_type'
    ];

    protected $table = 'internship_requirements';

    public function internshipData() {
        return $this->hasMany(InternshipData::class);
    }
}
