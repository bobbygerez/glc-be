<?php

use Illuminate\Database\Seeder;
use App\Model\PaymentOption;

class PaymentOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentOptions = ['Cash On Delivery', 'Credit Card/Paypal', 'Pera Padala'];

        foreach($paymentOptions as $payment){
            PaymentOption::create([
                'name' => $payment
            ]);
        }
    }
}
