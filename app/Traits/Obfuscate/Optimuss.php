<?php 

namespace App\Traits\Obfuscate;
use Jenssegers\Optimus\Optimus;

trait Optimuss
{
    
    public function optimus(){
        return new Optimus(1580030173, 59260789, 1163945558);

    }
    public function getOptimusIdAttribute(){
        return $this->optimus()->decode($this->id);
    }

    public function getValueAttribute(){
        return $this->optimus()->decode($this->id);
    }

    public function removeStringEncode($val){
        $res = preg_replace("/[^0-9]/", "", $val);
        return $this->optimus()->encode((int)$res);
    }

    //Id obfuscation should be resolveManually
    public function resolveRouteBinding($value)
    {
       return $this->where('id', $this->optimus()->encode($value) )->first() ?? abort(404);
    }

}