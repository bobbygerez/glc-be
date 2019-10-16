<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'path', 'imageable_id', 'imageable_type',
        'is_primary', 'name', 'desc'
    ];

    protected $appends = ['path_url'];
    public function imageable(){
    	return $this->morphTo();
    }

    public function getPathUrlAttribute(){
        return url($this->path);
    }

}
