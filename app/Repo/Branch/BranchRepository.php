<?php

namespace App\Repo\Branch;

use App\Model\Branch;
use App\Repo\BaseRepository;
use Auth;

class BranchRepository extends BaseRepository implements BranchInterface
{

    public function __construct()
    {

        $this->modelName = new Branch();
       
    }
    
    

    public function index($request){

        $branches = $this->whereLike('name', 'like', '%' . $request->filter . '%')
            ->when(!in_array(0, Auth::User()->roles->pluck('parent_id')->toArray()), function($q){
                $q->where('user_id', Auth::User()->id);
            })
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->paginate($branches);

       
    }
    
    public function create($request){
        $newRequest = $request->all();
        $newRequest['user_id'] = Auth::User()->id;
        $this->modelName->create($newRequest);
    }

    public function getStores(){
        if (Auth::User()->isSuperAdmin()) {
            return $this->modelName->all();
        }
        return $this->modelName->whereHas('user', function($q){
                    $q->where('id', Auth::User()->id);
                })->orderBy('created_at', 'desc')->get();
    }
}
