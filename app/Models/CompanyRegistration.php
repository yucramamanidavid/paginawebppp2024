<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'company_name',
        'acceptance_reason',
        'location',
        'contact',
        'additional_info',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
