<?php
namespace App\Services;

use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\User;

class InviteService
{
	public static function accept(Invite $invite)
	{
		$user = User::where("email", $invite->email)->first();
		$user_id = $user->id;

		$mayAlreadyEmployee = DigitalOfficeEmployee::where(
			"office_id",
			$invite->office_id
		)
			->where("user_id", $user_id)
			->first();

		if ($mayAlreadyEmployee) {
			$mayAlreadyEmployee->ended_at = null;
			$mayAlreadyEmployee->save();
		} else {
			$employee = DigitalOfficeEmployee::create([
				"office_id" => $invite->office_id,
				"user_id" => $user_id,
			]);

			$employee->assignRole("OfficeEmployee");

			if (!$user->profile) {
				$profile = new Profile();
				$profile->user_id = $user_id;
				$profile->save();
			}
		}

		$invite->delete();
	}
}
