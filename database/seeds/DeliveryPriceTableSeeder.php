<?php

use Illuminate\Database\Seeder;
use App\Model\DeliveryPrice;

class DeliveryPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $deliveryPrices = ['standard' => '50.00'];

        foreach($deliveryPrices as $k => $v){
            DeliveryPrice::create([
                'name' => $k,
                'amount' => $v
            ]);
        }
    }
}
