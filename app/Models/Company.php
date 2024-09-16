<?php

// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'contact_info'];

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class);
    }
    public function reviews()
    {
        return $this->hasMany(CompanyReview::class);
    }

}
