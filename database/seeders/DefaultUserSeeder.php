<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario por defecto
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(), // Para evitar la verificación de correo
            'must_change_password' => true, // Forzar cambio de contraseña
        ]);

        // Asignar el rol de "Administrador del Sistema" al usuario
        $adminRole = Role::where('name', 'Usuario Administrador del Sistema')->first();
        $user->assignRole($adminRole);
    }
}

