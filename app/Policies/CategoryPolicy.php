<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Obfuscate\OptimusPolicy;

class CategoryPolicy

{
    use HandlesAuthorization, OptimusPolicy;

    public function index(User $user)
    {
        return $this->accessable('Categories');

    }
    
    /**
     * Determine whether the user can view any categories.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
