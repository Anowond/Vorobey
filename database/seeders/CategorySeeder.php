<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Décalaration d'un tableau des différentes catégories, converties en collection
        // d'objets grâce au helper collect()
        $categories = collect([
            'Vêtements et Accéssoires',
            'Utilitaires',
            'Décorations',
        ]);

        // Création des catégories dans une boucle via une méthode each()
        $categories->each(fn($category) => Category::create([
            'name' => $category,
            'slug' => Str::slug($category),
        ]));
    }
}
