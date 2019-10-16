<?php

namespace App\Repo;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Obfuscate\Optimuss;
use App\Model\Address;
use App\Model\Information;
use App\Model\User;
use App\Model\TAccount;
use Auth;

class BaseRepository implements BaseInterface
{

    use Optimuss;

    protected $modelName;


    public function all()
    {
        return $this->modelName->all();
    }

    public function with($array = []){
        return $this->modelName->with($array);
    }

    public function orderBy($field, $value){
        return $this->modelName->orderBy($field, $value);
    }
    public function relTable(){
        return $this->modelName->relTable()->get();
    }

    public function create($array)
    {
        return $this->modelName->create($array);
    }

    public function where($name, $operator, $value = null)
    {
        if ($value === null) {
            return $this->modelName->where($name, $this->optimus()->encode($operator));
        }
        return $this->modelName->where($name, $operator, $this->optimus()->encode($value));
    }

    public function orWhere($name, $operator, $value = null)
    {
        if ($value === null) {
            return $this->modelName->where($name, $this->optimus()->encode($operator));
        }
        return $this->modelName->where($name, $operator, $this->optimus()->encode($value));
    }

    public function whereNoObfuscate($name, $operator, $value = null){
        if ($value === null) {
            return $this->modelName->where($name, $operator);
        }
        return $this->modelName->where($name, $operator, $value);
    }
    public function orWhereNoObfuscate($name, $operator, $value = null){
        if ($value === null) {
            return $this->modelName->where($name, $operator);
        }
        return $this->modelName->where($name, $operator, $value);
    }

    public function whereLike($name, $operator, $value = null)
    {
        return $this->modelName->where($name, $operator, $value);
    }

    public function update($array)
    {   
        return $this->modelName->update($array);
    }

    public function find($id)
    {
        return $this->modelName->find($this->removeStringEncode($id));
    }
    public function findNoObfuscate($id)
    {
        return $this->modelName->find($id);
    }

    public function entityNameAddress($request)
    {
        return $this->modelName->where('name', 'like', '%' . $request->filter . '%')
            ->when($request->sortBy === 'name', function ($q) use ($request) {
                $q->orderBy('name', $request->descending === 'false' ? 'asc' : 'desc');
            })
            ->orWhereHas('address', function ($q1) use ($request) {
                $q1->where('street_lot_blk', 'like', '%' . $request->filter . '%');
            })
            ->orWhereHas('address.brgy', function ($q1) use ($request) {
                $q1->where('description', 'like', '%' . $request->filter . '%');
            })
            ->orWhereHas('address.province', function ($q1) use ($request) {
                $q1->where('description', 'like', '%' . $request->filter . '%');
            })
            ->orWhereHas('address.city', function ($q1) use ($request) {
                $q1->where('description', 'like', '%' . $request->filter . '%');
            })
            ->orWhereHas('address.region', function ($q1) use ($request) {
                $q1->where('description', 'like', '%' . $request->filter . '%');
            });
    }

    public function paginate($collection)
    {
        if ($collection !== null) {
            $request = app()->make('request');
            $perPage = $request->perPage === '0' ? $collection->count() : $request->perPage;

            return new LengthAwarePaginator($collection->forPage($request->page, $perPage), $collection->count(), $perPage, $request->page);
        }
    }

    public function fillable($array){

        $modelName = $this->modelName;
        return collect($array)->filter(function ($value, $key) use ($modelName) {
            return in_array($key, $modelName->getFillable());
        })->toArray();
    }

    public function addressFillable($array)
    {
        $address = new Address;
        return collect($array)->filter(function ($value, $key) use ($address) {
            return in_array($key, $address->getFillable());
        })->toArray();
    }

    public function informationFillable($array)
    {
        $information = new Information;
        return collect($array)->filter(function ($value, $key) use ($information) {
            return in_array($key, $information->getFillable());
        })->toArray();
    }

    public function businessInfoFillable($array)
    {
        $businessInfo = new BusinessInfo;
        return collect($array)->filter(function ($value, $key) use ($businessInfo) {
            return in_array($key, $businessInfo->getFillable());
        })->toArray();
    }

    public function companiesNamePaginate($request)
    {
        return $this->paginate(
            Company::where('name', 'like', '%' . $request->filter . '%')
                ->orderBy('created_at', 'asc')
                ->get()
        );
    }

    public function branchesNamePaginate($request)
    {
        return $this->paginate(
            Branch::where('name', 'like', '%' . $request->filter . '%')
                ->where('company_id', $request->companyId)
                ->orderBy('created_at', 'asc')
                ->get()
        );
    }

    public function chartAccounts($modelType, $modelId)
    {
        return $modelType::where('id', $modelId)->with(['company.chartAccounts.allChildren'])
            ->first()->company->chartAccounts->where('parent_id', 0);
    }

    public function successApiResponse($message = null, $data = null)
    {
        $resp['success'] = 1;
        if ($message) {
            $resp['message'] = $message;
        }
        if ($data) {
            $resp['data'] = $data;
        }
        return $resp;
    }

    public function errorApiResponse($message = null, $data = null, $code = null)
    {
        // common response success: '', message: '', data: ''
        $resp['success'] = 0;
        if ($message) {
            $resp['message'] = $message;
        }
        if ($data) {
            $resp['data'] = $data;
        }
        if ($code) {
            return response($resp, $code);
        }

        return response($resp, 500);
    }

    public function apiResponse($result)
    {
        if ($result === true) {
            return [
                'success' => 1,
                'message' => 'Successfully created holding ' . $request['name'] . '.',
            ];
        } else {
            return response([
                'success' => 0,
                'message' => $result,
            ], 500);
        }
    }

    /**
     * validation methods
     */
    private function createValidationByField($data)
    {
        $validator = $this->validate($data, [key($data) => $this->rules[key($data)]]);
        return $validator->fails() ? $validator->errors() : true;
    }

    private function updateValidationByField($data, $id)
    {
        $validator = $this->validate($data, [key($data) => $this->getUpdateRules($id, array_keys($data))[key($data)]]);
        return $validator->fails() ? $validator->errors() : true;
    }

    public function validate($data, $rule)
    {
        return $validator = Validator::make($data, $rule);
    }
    
    // override this method in specific repository
    public function getUpdateRules($id, $ruleKeys = null)
    {
        $updateRule = $this->rules;
        if ($ruleKeys) {
            foreach ($ruleKeys as $value) {
                if (strpos($updateRule[$value], 'unique') !== false) {
                    $updateRule[$value] .= ',' . $id;
                }
            }
        } else {
            foreach ($updateRule as $key => $value) {
                if (strpos($value, 'unique') !== false) {
                    $updateRule[$key] .= ',' . $id;
                }
            }
        }
        
        return $updateRule;
    }

    /**
     * @param data = assoc array() 
     * @param
     * field (required) = string field that will be validated
     * value (required) = string value that will be validated
     * type (required) = string type of action ie. create/edit etc..
     * id (optional) = int used if validating for update action
     * @return mixed validation array result on error or a boolean true on success
     */
    public function asyncValidate($data)
    {
        // make the rule array to be pluck from the rule set
        $queryRule = [$data['field'] => $data['value']];
        // type checks
        $actionType = [
            'create' => function () use ($queryRule) {
                return $this->createValidationByField($queryRule);
            },
            'update' => function () use ($queryRule, $data) {
                return $this->updateValidationByField($queryRule, $data['id']);
            },
        ];
        // execute the validation action
        return $actionType[$data['type']]();
    }

    public function userCompanies(){
        
        $user = User::where('id', Auth::User()->id)->with('roles.accessRights.companies')->first();
        return $user->roles->map(function($role){
            return $role->accessRights;
        })->flatten(1)->map(function($accessRight){
            return $accessRight->companies;
        })->flatten(1);
    }

    public function when($condition, $function){
        return $this->modelName->when($condition, $function);
    }

    public function request(){
        return app()->make('request');
    }

    public function tAccounts(){
        return TAccount::all();
    }

    public function whereHas($attribute, \Closure $closure = null)
    {
        return $this->modelName->whereHas($attribute, $closure);
    }

    public function removeStringEncode($val){
        $res = preg_replace("/[^0-9]/", "", $val);
        return $this->optimus()->encode((int)$res);
    }
}