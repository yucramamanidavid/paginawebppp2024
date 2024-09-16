<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rol Administrador y asignar permisos
        $adminRole = Role::create(['name' => 'Administrador']);
        $adminRole->syncPermissions([
            'Ver dashboard',
            'Listar estudiantes',
            'Crear estudiantes',
            'Editar estudiantes',
            'Eliminar estudiantes',
            'Listar empresas',
            'Solicitar carta',
            'Subir Documentos',
            'Eliminar documentos',
        ]);

        // Crear rol Supervisor y asignar permisos
        $supervisorRole = Role::create(['name' => 'Supervisor']);
        $supervisorRole->syncPermissions([
            'Listar estudiantes',
            'Crear estudiantes',
            'Editar estudiantes',
            'Eliminar estudiantes',
            'Listar empresas',
        ]);

        // Crear rol Estudiante y asignar permisos
        $studentRole = Role::create(['name' => 'Estudiante']);
        $studentRole->syncPermissions([
            'Listar empresas',
            'Solicitar carta',
            'Subir Documentos',
            'Eliminar documentos',
        ]);
    }
}
