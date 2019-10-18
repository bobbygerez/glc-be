<?php

namespace App\Policies;

use App\Model\User;
use App\Model\GroupPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Obfuscate\OptimusPolicy;

class GGroupPolicy
{
    use HandlesAuthorization, OptimusPolicy;
    
    public function index(User $user)
    {
        return $this->accessable('Groups');

    }

    /**
     * Determine whether the user can view any group policies.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the group policy.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\GroupPolicy  $groupPolicy
     * @return mixed
     */
    public function view(User $user, GroupPolicy $groupPolicy)
    {
        //
    }

    /**
     * Determine whether the user can create group policies.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the group policy.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\GroupPolicy  $groupPolicy
     * @return mixed
     */
    public function update(User $user, GroupPolicy $groupPolicy)
    {
        //
    }

    /**
     * Determine whether the user can delete the group policy.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\GroupPolicy  $groupPolicy
     * @return mixed
     */
    public function delete(User $user, GroupPolicy $groupPolicy)
    {
        //
    }

    /**
     * Determine whether the user can restore the group policy.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\GroupPolicy  $groupPolicy
     * @return mixed
     */
    public function restore(User $user, GroupPolicy $groupPolicy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the group policy.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\GroupPolicy  $groupPolicy
     * @return mixed
     */
    public function forceDelete(User $user, GroupPolicy $groupPolicy)
    {
        //
    }
}
