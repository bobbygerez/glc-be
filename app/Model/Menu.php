<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;
use App\Scopes\MenuScope;

class Menu extends Model
{
   
    use Optimuss;
    protected $table = 'menus';
    protected $fillable = ['name', 'parent_id', 'path'];
    protected $appends = ['optimus_id', 'value', 'label'];

    protected static function boot(){
        parent::boot();
        // static::addGlobalScope(new MenuScope);
    }

    public function children() {

        return $this->hasMany('App\Model\Menu', 'parent_id', 'id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    } 

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'menu_role', 'role_id', 'menu_id');
    }

    public function getLabelAttribute(){
        return $this->name;
    }

}
