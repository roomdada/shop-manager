<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\TypeVariant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        TypeVariant::create([
            'type' => 'Couleur',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Taille',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Poids',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Matière',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Longueur',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Largeur',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Hauteur',
            'uuid' => Str::uuid(),
        ]);

        TypeVariant::create([
            'type' => 'Capacité',
            'uuid' => Str::uuid(),
        ]);

        $this->call([
            ProfilSeeder::class,
            KindSeeder::class,
            TypeSeeder::class,
            BrandSeeder::class,
        ]);

        // WithoutModelEvents::class;
        Article::factory(10)->create()->each(function ($article) {
            $stock = \App\Models\Stock::factory(1)->create([
               'article_id' => $article->id,
            ]);
            $article->update(['quantity' => $stock[0]->quantity_stoked]);
        });
    }
}
