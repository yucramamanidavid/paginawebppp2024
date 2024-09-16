<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nombre', 'ubicacion', 'contacto', 'motivo_aceptacion', 'user_id', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
