<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Catalog;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Obfuscate\OptimusPolicy;
class CatalogPolicy
{
    use HandlesAuthorization, OptimusPolicy;
    

    public function index(User $user)
    {
        return $this->accessable('Catalogs');

    }
    /**
     * Determine whether the user can view any catalogs.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the catalog.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Catalog  $catalog
     * @return mixed
     */
    public function view(User $user, Catalog $catalog)
    {
        //
    }

    /**
     * Determine whether the user can create catalogs.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the catalog.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Catalog  $catalog
     * @return mixed
     */
    public function update(User $user, Catalog $catalog)
    {
        //
    }

    /**
     * Determine whether the user can delete the catalog.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Catalog  $catalog
     * @return mixed
     */
    public function delete(User $user, Catalog $catalog)
    {
        //
    }

    /**
     * Determine whether the user can restore the catalog.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Catalog  $catalog
     * @return mixed
     */
    public function restore(User $user, Catalog $catalog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the catalog.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Catalog  $catalog
     * @return mixed
     */
    public function forceDelete(User $user, Catalog $catalog)
    {
        //
    }
}
