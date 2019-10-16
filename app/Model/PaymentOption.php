<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;
class PaymentOption extends Model
{
    use Optimuss;
    protected $table = 'payment_options';
    protected $fillable = ['name'];
    protected $appends = [ 'optimus_id'];
} 
