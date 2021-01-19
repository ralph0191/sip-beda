<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name', 'file_url', 'internship_data_id'
    ];

    protected $table = 'internship_files';

    public function internshipData() {
        return $this->belongsTo(InternshipData::class, 'internship_data_id');
    }
}
