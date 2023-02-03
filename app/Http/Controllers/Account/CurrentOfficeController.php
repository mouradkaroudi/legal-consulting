<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\User;
use Illuminate\Http\Request;

class CurrentOfficeController extends Controller
{
	/**
	 * Update the authenticated user's current office.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request)
	{
		$office = DigitalOffice::findOrFail($request->office_id);

		if (!$request->user()->switchOffice($office)) {
			abort(403);
		}

		return redirect(route('office.overview'), 303);
	}

	/**
	 * Logout the authenticated user's from current office
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout(Request $request)
	{

		if (!$request->user()->currentOffice) {
			abort(404);
		}

		$user = User::find($request->user()->id);

		$user->current_office_id = null;
		$user->save();

		return redirect(route('account.overview'), 303);
	}
}
