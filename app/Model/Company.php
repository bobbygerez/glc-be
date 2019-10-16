<?php

namespace App\Model;

use App\Traits\Model\Globals;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Obfuscate\Optimuss;

class Company extends Model
{

    use Globals, Optimuss;

    protected $table = 'companies';
    protected $fillable = [
        'name', 'desc', 'holding_id',
    ];

    protected $appends = ['optimus_id'];

    public function vendors()
    {

        return $this->hasMany('App\Model\Vendor', 'id', 'company_id');
    }

    public function branches()
    {

        return $this->hasMany('App\Model\Branch', 'id', 'company_id');
    }

    public function chartAccounts()
    {

        return $this->hasMany('App\Model\ChartAccount', 'company_id', 'id');
    }

    public function AccountingStandard()
    {

        return $this->hasMany('App\Model\AccountingStandard', 'id', 'company_id');
    }

    public function trademarks()
    {

        return $this->hasMany('App\Model\Trademark', 'id', 'company_id');
    }

    public function holding()
    {

        return $this->belongsTo('App\Model\Holding');
    }

    public function accessRights()
    {
        return $this->morphToMany('App\Model\AccessRight', 'accessable');
    }

    public function businessInfo()
    {

        return $this->morphOne('App\Model\BusinessInfo', 'businessable');
    }

    public function address()
    {

        return $this->morphOne('App\Model\Address', 'addressable');
    }

    // TODO: Commented transaction Type related causing bug atm
    //
    // public function transactionTypes(){

    //     return $this->hasMany('App\Model\TransactionType', 'company_id', 'id');
    // }
    public function scopeRelTable($q)
    {

        return $q->with(['businessInfo', 'branches', 'holding', 'address.country', 'address.region', 'address.province', 'address.city', 'address.brgy', 'chartAccounts']); // , 'transactionTypes']);
    }

}
