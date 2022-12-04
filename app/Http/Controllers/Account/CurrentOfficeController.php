<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
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
}
