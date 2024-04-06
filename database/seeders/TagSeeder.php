<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'une collection de tags
        $tags = collect([
            'Team Fortress 2',
            'Hacker Police',
            'Freak Show',
            'Live Gameplay',
            'Commentary',
        ]);

        // Boucle sur la collection pour créer les tags avec le mass assignment
        $tags->each(fn($tag) => Tag::create([
            'name' => $tag,
            'slug' => Str::slug($tag),
        ]));
    }
}
