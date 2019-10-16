<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RoleMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //17 roles
        //9 menus

        for($i=1; $i <= 2; $i++){
           $role = Role::find($i);
           for($m=1; $m <= 6; $m++){
                $role->menus()->attach($role->id, [
                    'menu_id' => $m,
                    'role_id' => $role->id
                ]);
           }
           
        }
    }
}
