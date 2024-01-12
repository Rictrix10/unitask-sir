<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adiciona as categorias
        Category::create([
            'name' => 'Profissional',
        ]);

        Category::create([
            'name' => 'Acadêmica',
        ]);

        Category::create([
            'name' => 'Criativa',
        ]);

        Category::create([
            'name' => 'Técnica',
        ]);

        Category::create([
            'name' => 'Projetos',
        ]);

        Category::create([
            'name' => 'Serviços',
        ]);

        Category::create([
            'name' => 'Saúde',
        ]);

        Category::create([
            'name' => 'Doméstica',
        ]);

        Category::create([
            'name' => 'Aprendizado',
        ]);

        Category::create([
            'name' => 'Entretenimento',
        ]);

        Category::create([
            'name' => 'Outra',
        ]);

        // Você pode adicionar mais categorias conforme necessário
    }
}
