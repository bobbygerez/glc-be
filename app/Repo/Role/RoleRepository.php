<?php 

namespace App\Repo\Role;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Role;
use Auth;
class RoleRepository extends BaseRepository implements RoleInterface{


    public function __construct(){

        $this->modelName = new Role();
    
    }

    public function createRole(){
        $role = $this->orWhereNoObfuscate('parent_id', Auth::User()->roles->min('parent_id'))
                ->with('allChildren')->first();
        
        return $role->allChildren;
    }

    public function store($request){
        $newRequest = $request->all();
        $newRequest['parent_id'] =  $this->optimus()->encode($request->parent_id);
       $role =  $this->modelName->create($newRequest);
       foreach($request->menu_id as $menu){
            $this->modelName->find($role->id)->menus()->attach($role->id, [
                'role_id' => $role->id,
                'menu_id' => $this->removeStringEncode($menu['value']) 
            ]);
       }    
    }

    public function updateRole( $request ){
        $newRequest = $request->all();
        if($request->parent_id != null){
            $newRequest['parent_id'] =  $this->optimus()->encode($request->parent_id);
        }else{
            $newRequest['parent_id'] = 0;
        }
        
        $role = $this->find($request->id);
        $array = [];
        foreach($request->menu_id as $menu){
            $array[] = $this->removeStringEncode($menu['value']) ;
        }
        $role->menus()->sync($array);
        $role->update( $newRequest );
    }
}