<?php

// database/seeders/StudentSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Student::factory(50)->create(); // Crear 50 estudiantes
    }
}
