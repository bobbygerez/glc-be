<?php

use Illuminate\Database\Seeder;
use App\Model\Catalog;

class CatalogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $catalogs = ['On Sale', 'New Product'];

        foreach($catalogs as $catalog){
            Catalog::create([
                'name' => $catalog
            ]);
        }
    }
}
