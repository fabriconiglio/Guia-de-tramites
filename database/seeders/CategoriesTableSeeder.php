<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Documentación',
            'Educación y cultura',
            'Ciencia y tecnología',
            'Economía y negocios',
            'Salud',
            'Seguridad y Justicia',
            'Turismo, deportes y recreación',
            'Transporte e infraestructura',
            'Trabajo y empleo',
            'Vivienda y familia',
            'Beneficios Sociales y Previsionales',
        ];

        foreach ($categories as $category) {
            Categorie::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category),
            ]);
        }
    }
}
