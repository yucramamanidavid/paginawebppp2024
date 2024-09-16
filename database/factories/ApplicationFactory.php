<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Student;
use App\Models\Convocatoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Asociar a un estudiante existente o crear uno nuevo
            'convocatoria_id' => Convocatoria::factory(), // Asociar a una convocatoria existente o crear una nueva
            'application_date' => $this->faker->dateTimeThisMonth,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}
