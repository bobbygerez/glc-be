<?php

use Illuminate\Database\Seeder;
use App\Model\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = ['Group A', 'Group B', 'Group C', 'Group D'];

        foreach($groups as $group){
            Group::create([
                'name' => $group
            ]);
        }
    }
}
