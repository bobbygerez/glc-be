<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;

class Branch extends Model
{
    
    use Optimuss;
    protected $table = 'branches';
    protected $fillable = [
        'user_id', 'name', 'desc'
    ];
    protected $appends = ['optimus_id'];

    public function user(){
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    public function address(){
        return $this->morphOne('App\Model\Address', 'addressable');
    }

    
}
