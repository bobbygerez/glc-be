<?php 

namespace App\Repo\Store;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Store;
use App\Traits\Obfuscate\Optimuss;
use Auth;
class StoreRepository extends BaseRepository implements StoreInterface{

    use Optimuss;
    
    public function __construct(){

        $this->modelName = new Store();
    
    }

    public function create($request){
        $newRequest = $request->all();
        $newRequest['user_id'] = Auth::User()->id;
        $this->modelName->create($newRequest);
    }

    

}