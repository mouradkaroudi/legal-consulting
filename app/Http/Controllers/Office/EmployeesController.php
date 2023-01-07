<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(DigitalOfficeEmployee::class, 'employee');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view("pages.office.employees.index", [
			"officeId" => auth()->user()->currentOffice->id,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(DigitalOfficeEmployee $employee)
	{
		return view("pages.office.employees.edit", [
			"DigitalOfficeEmployee" => $employee,
		]);
	}
}
