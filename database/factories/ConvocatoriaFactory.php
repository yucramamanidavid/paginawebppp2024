<?php

// database/factories/ConvocatoriaFactory.php

namespace Database\Factories;

use App\Models\Convocatoria;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConvocatoriaFactory extends Factory
{
    protected $model = Convocatoria::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'company_id' => Company::factory(), // Asociar a una empresa existente o crear una nueva
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'location' => $this->faker->address,
            'benefits' => $this->faker->text,
            'requirements' => $this->faker->text,
            'application_instructions' => $this->faker->text,
        ];
    }
}
