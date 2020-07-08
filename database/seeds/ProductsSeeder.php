<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Avatar($faker));

        for ($i=0; $i < 40; $i++) { 
            Product::create([
                'barcode' => $faker->ean13,
                'image' => $faker->avatar,
                'name' => $faker->colorName,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'price' => $faker->randomNumber($nbDigits = NULL, $strict = true),
                'category_id' => rand(1, 10),
                'user_id' => 1,
            ]);
        }
    }
}
