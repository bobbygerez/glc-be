<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'computer' => 'Dining',
            'perm_data_setting' => 'Table', 
            'extension' => 'Chairs'
        ];

        foreach ($categories as $key => $value) {
        	Category::create([
                    'parent_id' => 0,
                    'name' => $value,
                    'url' => str_slug($value, '-') 
        		]);
        }

    }
}
