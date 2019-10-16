<?php

use Illuminate\Database\Seeder;
use App\Model\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 3 ; $i++) { 
            Branch::create([
                'user_id' => rand(1, 2),
                'name' => 'Store ' . $i,
                'mobile' => rand(1000, 2000),
                'desc' => 'Desc' . $i
            ]);
        }
    }
}
