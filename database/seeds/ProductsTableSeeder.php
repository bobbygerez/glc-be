<?php

use Illuminate\Database\Seeder;
use App\Model\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i < 30 ; $i++) { 
           $product = Product::create([
               'category_id' => rand(1, 3),
                'item_code' => strtoupper(substr(md5(mt_rand()), 0, 8)),
                'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            ]);

            $product = Product::find($product->id);
            $product->images()->create([
                'path' => 'images/uploads/' . rand(1,37) . '.jpg',
                'is_primary' => 1,
                'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
            ]);
            $product->images()->create([
                'path' => 'images/uploads/' . rand(1,37) . '.jpg',
                'is_primary' => 0,
                'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
            ]);
            $product->images()->create([
                'path' => 'images/uploads/' . rand(1,37) . '.jpg',
                'is_primary' => 0,
                'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
            ]);
            $product->images()->create([
                'path' => 'images/uploads/' . rand(1,37) . '.jpg',
                'is_primary' => 0,
                'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)
            ]);
        }
    }
}
