<?php

namespace App\Model;

use App\Traits\Obfuscate\Optimuss;
use Illuminate\Database\Eloquent\Model;
use App\Model\Category;

class Product extends Model
{

    use Optimuss;
    protected $table = 'products';
    protected $fillable = [
        'category_id', 'catalog_id', 'item_code', 'name', 
        'desc'
    ];

    protected $appends = [ 'slug_name', 'optimus_id'];

    public static function boot() {
        parent::boot();
        static::deleting(function($product) {
            foreach($product->images as $img){
                unlink(public_path().'/'.$img->path);
            }
            $product->images()->delete();
        });
    }


    public function images()
    {
        return $this->morphMany('App\Model\Image', 'imageable', 'imageable_type', 'imageable_id');
    }

    public function category()
    {
        return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

    public function catalog(){
         return $this->hasOne('App\Model\Catalog', 'id', 'catalog_id');
    }

    public function groups(){
        return $this->belongsToMany('App\Model\Group', 'group_product', 'group_id', 'product_id');
    }

    public function getSlugNameAttribute()
    {
        return str_slug($this->name);
    }

    public function scopeRelTable($q)
    {
        return $q->with(['images', 'category.allParent']);
    }

    public function getCategorySlugNameAttribute()
    {
        return $this->category->slug_name;
    }

    public function resolveRouteBinding($value)
    {
       return $this->where('id', $this->optimus()->encode($value) )->first() ?? abort(404);
    }

}
