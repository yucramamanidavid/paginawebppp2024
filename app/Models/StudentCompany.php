<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentCompany extends Model
{
    use HasFactory;
    use Notifiable;

    // Asegúrate de incluir solo los campos que se pueden rellenar
    protected $fillable = [

        'name',
        'acceptance_reason',
        'location',
        'contact',
        'additional_info',
        'status'
    ];

    // Define relaciones si es necesario (ejemplo)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function reviews()
    {
        return $this->hasMany(CompanyReview::class);
    }


}
