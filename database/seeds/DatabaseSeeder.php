<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(HoldingsTableSeeder::class);
        // $this->call(CompaniesTableSeeder::class);
        // $this->call(TaccountsTableSeeder::class);
        // $this->call(ChartAccountsTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(BranchesTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(TaxTypeTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(MenusTableSeeder::class);
        // $this->call(RoleMenuTableSeeder::class);
        // $this->call(GroupTableSeeder::class);
          $this->call(CatalogTableSeeder::class);
     
    }
}
