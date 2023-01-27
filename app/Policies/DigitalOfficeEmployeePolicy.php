<?php

namespace App\Policies;

use App\Models\DigitalOfficeEmployee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DigitalOfficeEmployeePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user)
	{
		return $user->hasOfficePermission(
			$user->currentOffice,
			"manage-employees"
		);
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\DigitalOfficeEmployee  $digitalOfficeEmployee
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, DigitalOfficeEmployee $digitalOfficeEmployee)
	{
		return $user->hasOfficePermission(
			$user->currentOffice,
			"manage-employees"
		);
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\DigitalOfficeEmployee  $digitalOfficeEmployee
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(
		User $user,
		DigitalOfficeEmployee $digitalOfficeEmployee
	) {
		// The employee should belong/belonged to the user current office
		// The user should either be the owner or have permission to manage employees

		// Office owner cannot be edited
		if($digitalOfficeEmployee->user->currentOffice && $digitalOfficeEmployee->isOwner($digitalOfficeEmployee->user->currentOffice)) {
			return false;
		}

		if( $user->ownsOffice($user->currentOffice) ) {
			return true;
		}

		if (
			$user->id !== $digitalOfficeEmployee->user_id
			&&
			$digitalOfficeEmployee->office_id == $user->currentOffice->id
			&&
			$user->hasOfficePermission(
				$user->currentOffice,
				"manage-employees"
			)
		) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\DigitalOfficeEmployee  $digitalOfficeEmployee
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(
		User $user,
		DigitalOfficeEmployee $digitalOfficeEmployee
	) {
		return false;
	}
}
