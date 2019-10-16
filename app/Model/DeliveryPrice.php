<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryPrice extends Model
{
    
    protected $table = 'delivery_prices';
    protected $fillable = ['name', 'amount'];

    public function getAmountAttribute($val){
        return (float)$val;
    }
}
