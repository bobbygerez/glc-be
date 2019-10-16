<?php 

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class PaymentScope implements Scope
{

    use Optimuss;
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        
        $builder->whereHas('items', function($q){
            $q->whereIn('role_id',  Auth::User()->roles->pluck('id') );
        });
        
    }
}

?>