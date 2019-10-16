<?php 

namespace App\Repo\Catalog;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Catalog;
class CatalogRepository extends BaseRepository implements CatalogInterface{


    public function __construct(){

        $this->modelName = new Catalog();
    
    }

    public function index($request){

        $c = $this->modelName->where('name', 'like', '%' . $request->filter . '%')->get();

        return $this->paginate($c);

       
    }

}