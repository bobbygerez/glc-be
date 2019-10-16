<?php

use App\Imports\ChartAccountImport;
use Illuminate\Database\Seeder;
use App\Model\ChartAccount;
class ChartAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Excel::import(new ChartAccountImport, public_path() . '/csv/chartofaccounts.csv');

        $categories = ['Assets', 'Liabilities', 'Capital/Equities', 'Incomes', 'Expenses'];
        $faker = Faker\Factory::create();
        for ($x = 1; $x <= 98; $x++) {
            for ($i = 1; $i <= 5; $i++) {

                ChartAccount::create([
                    'company_id' => $x,
                    'parent_id' => 0,
                    'name' => $categories[$i - 1],
                    'account_code' => $i . '0',
                    'taccount_id' => rand(1, 2),
                    'account_display' => $i . '0' . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
                ]);

            }
        }

        for ($i = 1; $i < 10; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => 1,
                'name' => 'Assets-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 10 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }
        for ($i = 1; $i < 10; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => 2,
                'name' => 'Liabilities' . '-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 20 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }
        for ($i = 1; $i < 10; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => 3,
                'name' => 'Capital/Equities' . '-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 30 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }
        for ($i = 1; $i < 10; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => 4,
                'name' => 'Incomes' . '-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 40 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }
        for ($i = 1; $i < 10; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => 5,
                'name' => 'Expenses' . '-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 50 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }
        for ($i = 1; $i < 99; $i++) {

            ChartAccount::create([
                'company_id' => $i,
                'parent_id' => rand(6, 98),
                'name' => 'random' . '-' . $i,
                'account_code' => rand(1, 99),
                'taccount_id' => rand(1, 2),
                'account_display' => 50 . '-' . rand(1, 99) . '-' . rand(1, 99) . '-' . rand(1, 99),
            ]);

        }

    }
}
