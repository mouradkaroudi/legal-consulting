<?php
namespace App\Services;

use App\Events\Office\InviteSent;
use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Str;

class InviteService
{

	/**
	 * Send invite to user
	 */
	public static function send( DigitalOffice $office, $user_email ) {
		
		$user = User::where('email', $user_email)->first();

		if($user && $user->belongsToOffice($office)) {
			throw new \Exception("User already added as employee to this office", 1);
		}
		
		$token =  Str::random(16);

		$invite = Invite::create([
			'office_id' => $office->id,
			'email' => $user->email,
			'token' => $token
		]);

		InviteSent::dispatch($invite);
	}

	/**
	 * Accept employement invitation from office
	 * 
	 * @param $invite
	 */
	public static function accept(Invite $invite): void
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
