<?php

// database/seeders/ConvocatoriaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convocatoria;

class ConvocatoriaSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Convocatoria::factory(20)->create(); // Crear 20 convocatorias
    }
}
