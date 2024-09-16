<?php

// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        \App\Models\Company::factory(10)->create(); // Crear 10 empresas
    }
}
