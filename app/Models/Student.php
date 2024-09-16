<?php

// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['name', 'email', 'phone', 'program'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function companyReviews()
    {
        return $this->hasMany(CompanyReview::class);
    }
    public function workHours()
    {
        return $this->hasMany(WorkHours::class);
    }


}
