<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;

    protected $fillable = ['student_company_id', 'student_id', 'status', 'feedback'];

    // public function StudentCompany()
    // {
    //     return $this->belongsTo(StudentCompany::class);
    // }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studentCompany()
    {
        return $this->belongsTo(StudentCompany::class, 'student_company_id');
    }

}
