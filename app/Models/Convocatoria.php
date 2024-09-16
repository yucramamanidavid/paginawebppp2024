<?php

// app/Models/Convocatoria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'company_id', 'deadline', 'location', 'benefits', 'requirements', 'application_instructions'];
    protected $dates = ['deadline'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

