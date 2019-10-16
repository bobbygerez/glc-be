<?php 

namespace App\Repo\Menu;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Menu;
use App\Model\User;
use Auth;

class MenuRepository extends BaseRepository implements MenuInterface{

    public function __construct(){

        $this->modelName = new Menu();
    
    }

    public function index(){
     
        $user = User::where('id', Auth::User()->id)
            ->with(['roles.allChildren.menus.allChildren', 'roles.menus.allChildren'])
            ->first();
        // $userRoles = $user->roles->flatMap(function($val){
        //     return $val->menus;
        // });

        return collect( $this->mapRecursive( $user->roles ) )->flatten(1)->unique('id')->values()->all();
        
    }

    public function mapRecursive($array) {
        $result = [];
        foreach ($array as $item) {
            if($item['menus'] != null){
                $result[] = $item['menus'];
            }
            $result = array_merge($result, $this->mapRecursive($item['allChildren']));
        }
        return array_filter($result);
    }
}