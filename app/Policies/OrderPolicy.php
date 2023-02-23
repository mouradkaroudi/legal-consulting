<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User|Admin $user)
    {

        if($user instanceof Admin) {
            return true;
        }

		return $user->hasOfficePermission(
			$user->currentOffice,
			"manage-orders"
		);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User|Admin $user, Order $order)
    {
        if($user instanceof Admin) {
            return true;
        }

        return $user->id == $order->beneficiary_id || $user->hasOfficePermission($order->office, 'manage-orders');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User|Admin $user)
    {
        if($user instanceof Admin) {
            return true;
        }

        return $user->hasOfficePermission($user->currentOffice, 'manage-orders');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User|Admin $user, Order $order)
    {
        if($user instanceof Admin) {
            return true;
        }
        return $user->id == $order->beneficiary_id || $user->hasOfficePermission($order->office, 'manage-orders');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User|Admin $user, Order $order)
    {
        if($user instanceof Admin) {
            return true;
        }
        
        if( $order->status == Order::PAID ) {
            return false;
        }

        return $user->ownsOffice($order->office);

    }

}
