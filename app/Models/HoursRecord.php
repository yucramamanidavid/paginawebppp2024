<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoursRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'supervisor_id',
        'date',
        'hours',
        'activity_description',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
