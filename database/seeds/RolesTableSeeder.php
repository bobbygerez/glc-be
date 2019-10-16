<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin'];
        $roles2 = ['User'];
         
        foreach ($roles as $value) {
            $role = Role::create([
                    'name' => $value,
                    'parent_id' => 0,
                    
                ]);
        }
        foreach ($roles2 as $value) {
            $role = Role::create([
                    'name' => $value,
                    'parent_id' => 1,
                    
                ]);
        }
       
    }
}
