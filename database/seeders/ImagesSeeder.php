<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 40; $i++) {
            for ($x = 0; $x < 4; $x++) {

                $width = $faker->numberBetween(300, 800);  // Random width between 300-800px
                $height = $faker->numberBetween(200, 600); // Random height between 200-600px
                $bgColor = sprintf('%06X', mt_rand(0, 0xFFFFFF)); // Generate random HEX color
                $text = $faker->word; // Random word for text

                // Create the image URL with dynamic parameters
                $imageUrl = "https://images.mohmadyazansweed.nl/?width={$width}&height={$height}&bg={$bgColor}&text=" . urlencode($text);



                Images::create([

                    'url' => $imageUrl,
                    'products_id' => $i+1,
                ]);
                }

        }
    }
}