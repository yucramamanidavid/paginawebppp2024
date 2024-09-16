<?php

// database/factories/CompanyFactory.php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'location' => $this->faker->address,
            'contact_info' => $this->faker->phoneNumber,
        ];
    }
}

