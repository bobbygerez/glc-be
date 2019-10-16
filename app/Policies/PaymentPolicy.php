<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\Obfuscate\OptimusPolicy;
class PaymentPolicy
{
    use HandlesAuthorization, OptimusPolicy;

    public function index(User $user)
    {
        return $this->accessable('Payments');

    }
    
    /**
     * Determine whether the user can view any payments.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the payment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Payment  $payment
     * @return mixed
     */
    public function view(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can create payments.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can restore the payment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Payment  $payment
     * @return mixed
     */
    public function restore(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payment.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Payment  $payment
     * @return mixed
     */
    public function forceDelete(User $user, Payment $payment)
    {
        //
    }
}
