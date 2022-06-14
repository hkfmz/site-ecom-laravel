<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'High Tech',
            'slug' => 'high-tech'
        ]);

        Category::create([
            'name' => 'Livres',
            'slug' => 'livres'
        ]);

        Category::create([
            'name' => 'Fruits',
            'slug' => 'fruits'
        ]);

        Category::create([
            'name' => 'Jeux',
            'slug' => 'jeux'
        ]);

        Category::create([
            'name' => 'Sport',
            'slug' => 'sport'
        ]);

        Category::create([
            'name' => 'Plantes',
            'slug' => 'plantes'
        ]);
    }
}
