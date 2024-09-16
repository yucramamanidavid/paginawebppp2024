<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    protected $fillable = ['name'];
    public function practicing(){
        return $this->hasMany(practicing::class);
    }
    public function hoursRecords()
    {
        return $this->hasMany(HoursRecord::class);
    }
    public function workHours()
    {
        return $this->hasMany(WorkHours::class);
    }
}
