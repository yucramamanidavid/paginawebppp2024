<?php

// app/Models/Application.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'convocatoria_id', 'application_date', 'status'];
    protected $dates = ['application_date'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class);
    }
}
