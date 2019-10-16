<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentProduct extends Model
{
    protected $table = 'payment_product';
    protected $fillable = [
        'payment_id', 'product_id', 'quantity', 'price'
    ];

    public function product(){
        return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }
}
