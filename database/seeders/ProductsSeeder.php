<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 40; $i++) {
            Products::create([
            'name' => $faker->name(),
            'brand' => $faker->company(),
            'description' => $faker->text(),
            'price' => $faker->randomFloat(2, 0, 100),
            'in_stock'=> true,
            'gender'=> "male"


            ]);
        }
    }
}
