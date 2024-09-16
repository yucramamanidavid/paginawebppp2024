<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    public function passes($attribute, $value)
    {
        // Ejemplo de validación simple para un número de teléfono
        return preg_match('/^\+?[0-9]{7,15}$/', $value);
    }

    public function message()
    {
        return 'El :attribute no es un número de teléfono válido.';
    }
}
