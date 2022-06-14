<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,40) as $index)
        {
            Product::create([
                'title' => $faker->sentence(4),
                'slug' => $faker->slug,
                'subtitle' => $faker->sentence(3),
                'description' => $faker->sentence(18*4),
                'price' => $faker->numberBetween(15, 300)*100,
                'image' => 'https://via.placeholder.com/200x250.png',
                'created_at'=> $faker->dateTimeBetween($startDate = '-1 day', $endDate = 'now'),
            ])->categories()->attach([
                rand(1,4),
                rand(1,4)
            ]);
        }

    }
}
