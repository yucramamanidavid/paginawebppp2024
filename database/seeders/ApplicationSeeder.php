<?php

// database/seeders/ApplicationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Application::factory(100)->create(); // Crear 100 aplicaciones
    }
}
