<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Obfuscate\OptimusPolicy;

class ProductPolicy
{
    use HandlesAuthorization, OptimusPolicy;

    public function index(User $user)
    {
        return $this->accessable('Products');

    }
    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return true;
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return true;
    }
}
