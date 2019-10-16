<?php 

namespace App\Repo\Group;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Group;
class GroupRepository extends BaseRepository implements GroupInterface{


    public function __construct(){

        $this->modelName = new Group();
    
    }

    public function index($request){

        $groups = $this->modelName->where('name', 'like', '%' . $request->filter . '%')->get();

        return $this->paginate($groups);

       
    }

}