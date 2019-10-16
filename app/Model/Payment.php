<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;
class Payment extends Model
{
    use Optimuss;
    protected $table = 'payments';
    protected $fillable = [
        'payment_id',
        'mobile',
        'lat',
        'lng',
        'user_id',
        'payment_option_id',
        'grand_total',
        'delivery_amount'
    ];
    protected $appends = ['optimus_id'];
    public function paymentProducts(){
        return $this->hasMany('App\Model\PaymentProduct', 'payment_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    public function paymentOption(){
        return $this->hasOne('App\Model\PaymentOption', 'id', 'payment_option_id');
    }

    public function getLatAttribute($v){
        return (float)$v;
    }

    
    public function getLngAttribute($v){
        return (float)$v;
    }
}
