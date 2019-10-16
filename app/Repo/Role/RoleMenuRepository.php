<?php 

namespace App\Repo\Role;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Role;
use Auth;
class RoleMenuRepository extends BaseRepository implements RoleInterface{


    public function __construct(){

        $this->modelName = new Role();
    
    }

    public function index(){

        return Auth::User()->with(['roles.menus', 'roles.allChildren.menus'])->first();
    }

}