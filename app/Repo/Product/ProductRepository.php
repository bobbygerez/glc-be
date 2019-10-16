<?php

namespace App\Repo\Product;

use App\Model\Product;
use App\Repo\BaseRepository;

class ProductRepository extends BaseRepository implements ProductInterface
{

    public function __construct()
    {
        $this->modelName = new Product();
    }

    public function create($request)
    {
        


        $product = $this->modelName->create($request);
        $array = $request['images'];
        foreach ($array as $key => $image) {
            $image = str_replace('data:image/png;base64,', '', $image['dataURL']);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10) . '.' . 'png';
            \File::put(public_path() . '/images/uploads/' . $imageName, base64_decode($image));

            reset($array);
            //first
            if ($key === key($array)) {
                Image::create([
                    'path' => 'images/uploads/' . $imageName,
                    'imageable_id' => $product->id,
                    'imageable_type' => 'App\Model\Product',
                    'is_primary' => true,
                    'name' => $imageName,
                    'desc' => $request['desc'],
                ]);
            }else{
                Image::create([
                    'path' => 'images/uploads/' . $imageName,
                    'imageable_id' => $product->id,
                    'imageable_type' => 'App\Model\Product',
                    'is_primary' => false,
                    'name' => $imageName,
                    'desc' => $request['desc'],
                ]);
            }

            end($array);
            //Last 
            if ($key === key($array)) {
            }

        }
    }

    

}
