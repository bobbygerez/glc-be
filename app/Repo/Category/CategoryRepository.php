<?php 

namespace App\Repo\Category;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\Category;

class CategoryRepository extends BaseRepository implements CategoryInterface{


    public function __construct(){

        $this->modelName = new Category();
    
    }

    public function mainCategories(){
        return $this->modelName->where('parent_id', 0);
    }

    public function subCategories($id){
        return $this->modelName->where('parent_id', $id);
    }

    public function moreCategories($id){
        return $this->modelName->where('parent_id', $id);
    }

    public function categoriesAll(){

        return $categories = $this->modelName->with('allChildren')->where('parent_id', 0)->get();

    }
}