<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\Model\Globals;
use App\Traits\Obfuscate\Optimuss;
class AccessRight extends Model
{

    use Globals, Optimuss;
    
    protected $table = 'access_rights';

    protected $fillable = ['name', 'description'];
    
    protected $appends = ['optimus_id'];


    public function menus()
    {
        return $this->morphedByMany('App\Model\Menu', 'accessable');
    }

    public function branch()
    {
        return $this->morphedByMany('App\Model\Branch', 'accessable');
    }

    public function items()
    {
        return $this->morphedByMany('App\Model\Item', 'accessable');
    }

    public function roles(){
        return $this->belongsToMany('App\Model\Role', 'access_right_role', 'access_right_id', 'role_id');
    }

    public function scopeRelTable($query){
        return $query->with(['roles', 'menus']);
    }

    public function getNameAttribute($val){
        return ucwords($val);
    }
}
