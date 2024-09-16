<?php

namespace Database\Factories;

use App\Models\CompanyRegistration;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyRegistration>
 */
class CompanyRegistrationFactory extends Factory
{
    protected $model = CompanyRegistration::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Suponiendo que tengas un factory para Student
            'company_name' => $this->faker->company,
            'acceptance_reason' => $this->faker->text,
            'location' => $this->faker->address,
            'contact' => $this->faker->email,
            'additional_info' => $this->faker->text,
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
        ];
    }
}
