<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Usuario Administrador del Sistema' => 'Este rol tiene acceso total al sistema para gestionar usuarios, roles y trámites.',
            'Usuario Editor de Trámites' => 'Este rol permite editar trámites.',
        ];

        foreach ($roles as $name => $description) {
            Role::create([
                'name' => $name,
                'description' => $description, // Asegúrate de que la columna 'description' exista en tu tabla 'roles'
            ]);
        }
    }
}


