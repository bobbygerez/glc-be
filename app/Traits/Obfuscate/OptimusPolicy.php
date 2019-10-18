<?php 

namespace App\Traits\Obfuscate;
use Jenssegers\Optimus\Optimus;
use App\Model\User;
use Auth;
trait OptimusPolicy
{
    
    public function accessable($menu){

        $user = User::where('id', Auth::User()->id)
            ->with(['roles.menus'])->first();
        $menus = $user->roles->flatMap(function($v){
                return $v->menus;
            })->pluck('name')->values()->all();
        if( in_array($menu, $menus) ){
            return true;
        }else{
            return false;
        }
       
    }

}