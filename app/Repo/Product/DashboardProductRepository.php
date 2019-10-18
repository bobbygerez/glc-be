<?php

namespace App\Repo\Product;

use App\Model\Product;
use App\Repo\BaseRepository;
use Auth;
use App\Model\Branch;
use App\Model\Image;

class DashboardProductRepository extends BaseRepository implements ProductInterface
{

    public function __construct()
    {
        $this->modelName = new Product();
    }

    public function index($request){
        return $this->whereLike('name', 'like', '%' . $request->filter . '%')
                ->with(['category', 'catalog'])
                ->orderBy('created_at', 'desc')->get();
    }


    public function edit($request){

       $product = $this->where('id',$request->id)
                ->with(['catalog', 'category', 'groups', 'images'])
                ->first();

       return [
           'product' => $product
       ];
    }

    //Flatten Recursive
    public function flatten($array) {
        $result = [];
        foreach ($array as $item) {
            if(is_array($item)){
                $result[] = $item['all_parent'];
                $result = array_merge($result, $this->flatten($item['allParent']));
            }
            
        }
        return array_filter($result);
    }

    public function update($request){
       $product = $this->find($request->optimus_id);
       $productImages = $product->images;
       
       foreach($productImages as $img){
            if(!in_array($img->id, $request->ids)){
                $img->delete();
            }
       }
       if($request->ids != null){
            $images = Image::whereIn('id', $request->ids)->get();

            foreach($images as $image){
                if($request->is_primary === $image->name){
                    Image::find($image->id)->update([
                        'is_primary' => true
                    ]);
                }else{
                    Image::find($image->id)->update([
                        'is_primary' => false
                    ]);
                }
            }
       }

       $this->addImages($product, $request);
       
       $newRequest = $request->all();
       $newRequest['category_id'] = $this->removeStringEncode( $request->category_id );
       $newRequest['catalog_id'] = $this->removeStringEncode( $request->catalog_id );

        $groupIds = explode(',', $request->group_ids);
        $product->groups()->sync($groupIds);
        $product->update($newRequest);
   
}



    public function create($request)
    {
        $newRequest = $request->all();
        $newRequest['catalog_id'] = $this->removeStringEncode( $request->catalog_id );
        $product = $this->modelName->create($newRequest);
        $product = $this->modelName->find($product->id);

        $groupIds = explode(',', $request->group_ids);
        foreach($groupIds as $id){
            $product->groups()->attach($product->id, [
                'product_id' => $product->id,
                'group_id' => $id
            ]);
        }
        
        $this->addImages($product, $request);

    }

    public function addImages($product, $request){
        if(isset($_FILES["files"]["name"])){
            foreach($_FILES["files"]["name"] as $key=>$tmp_name){
                $file_name= str_random(32) . '-'. $_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $uploadfile = file_get_contents($file_tmp);

                \File::put(public_path() . '/images/uploads/'.$file_name, $uploadfile);

                if ($_FILES["files"]["name"][$key] === $request->is_primary) {
                    Image::create([
                        'path' => 'images/uploads/' . $file_name,
                        'imageable_id' => $product->id,
                        'imageable_type' => 'App\Model\Product',
                        'is_primary' => true,
                        'name' => $file_name,
                        'desc' => $file_name,
                    ]);
                    
                }else{
                    Image::create([
                        'path' => 'images/uploads/' . $file_name,
                        'imageable_id' => $product->id,
                        'imageable_type' => 'App\Model\Product',
                        'is_primary' => false,
                        'name' => $file_name,
                        'desc' => $file_name,
                    ]);
                }
            }
        }

    }

}
