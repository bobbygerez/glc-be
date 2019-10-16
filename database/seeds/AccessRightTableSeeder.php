<?php

use Illuminate\Database\Seeder;
use App\Model\AccessRight;
use App\Model\Menu;
use App\Model\Branch;

class AccessRightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accessRights = ['index', 'create', 'read', 'store', 'edit', 'update'];

        foreach ($accessRights as $value) {

            $accessRight = AccessRight::create([
                'name' => $value,
            ]);

            $accessRight = AccessRight::find($accessRight->id);
            $accessRight->roles()->attach($accessRight->id, [
                'role_id' => 1,
                'access_right_id' => $accessRight->id,
            ]);
            $accessRight->roles()->attach($accessRight->id, [

                'role_id' => 2,
                'access_right_id' => $accessRight->id,
            ]);

            $accessRight->roles()->attach($accessRight->id, [

                'role_id' => 3,
                'access_right_id' => $accessRight->id,
            ]);

        }

        for($a=1; $a < 9; $a++) {

            for ($i=1; $i < 5; $i++) { 
                
                $menu = Menu::find($a);
                $accessRight = AccessRight::find($i);
                $accessRight->menus()->attach([$a]);
            }

        }

        for($a=1; $a < 29; $a++) {

            for ($i=1; $i < 5; $i++) { 
                
                $branch = Branch::find(rand(1, 29));
                $accessRight = AccessRight::find($i);
                $accessRight->branch()->attach([$a]);
            }

        }

    }
}
