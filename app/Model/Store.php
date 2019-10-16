<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;

class Store extends Model
{
    use Optimuss;
    protected $table = 'stores';
    protected $fillable = ['name', 'desc', 'user_id'];
    protected $appends = ['optimus_id'];

    public function users(){
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    // public function resolveRouteBinding($value)
    // {
    //    return $this->where('id', $this->optimus()->encode($value) )->first() ?? abort(404);
    // }
}
