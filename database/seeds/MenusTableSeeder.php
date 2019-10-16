<?php

use Illuminate\Database\Seeder;
use App\Model\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            1 => [ 'path' => '/dashboard/profile', 'icon' => 'account_circle', 'name' => 'Profile'],
            2 => [ 'path' => '/dashboard/groups', 'icon' => 'fas fa-users', 'name' => 'Groups'],
            3 => [ 'path' => '/dashboard/users', 'icon' => 'supervisor_account', 'name' => 'Users'],
            4 => [ 'path' => '/dashboard/roles', 'icon' => 'recent_actors', 'name' => 'Roles'],
            5 => [ 'path' => '/dashboard/categories', 'icon' => 'list', 'name' => 'Categories'],
            6 => [ 'path' => '/dashboard/catalogs', 'icon' => 'dashboard', 'name' => 'Catalogs'],
            7 => [ 'path' => '/dashboard/products', 'icon' => 'laptop_mac', 'name' => 'Products'],
        ];

        foreach ($menus as $k => $v) {
            Menu::create([
                'icon' => $v['icon'],
                'parent_id' => 0,
                'path' => $v['path'],
                'name' => $v['name']
            ]);
        }
    }
}
