<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;
use App\Traits\Model\Globals;

class Group extends Model
{

    use Optimuss, Globals;

    protected $table = 'groups';
    protected $fillable = ['name'];
    protected $appends = ['optimus_id', 'value', 'label'];

    public function getLabelAttribute(){
        return $this->name;
    }
}
