<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $fillable = ["name", "email", "password", "gender", "withdrawal_methods", "preferred_lang", "address", "ID_number", "ID_image", "driving_license_image", "country_id"];

	protected $hidden = ["password", "remember_token"];

	protected $casts = [
		"email_verified_at" => "datetime",
		"withdrawal_methods" => "array"
	];

	/**
	 * User country
	 */
	public function country()
	{
		return $this->hasOne(Country::class, "id", "country_id");
	}

	/**
	 * Determine if the given office is the current office.
	 *
	 * @param  mixed  $digitalOffice
	 * @return bool
	 */
	public function isCurrentOffice($digitalOffice)
	{
		return $digitalOffice->id == $this->currentOffice->id;
	}

	/**
	 * Get the current office of the user's context.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function currentOffice()
	{
		if (is_null($this->current_office_id) && $this->id) {
			//$this->switchOffice();
		}

		return $this->belongsTo(DigitalOffice::class, "current_office_id");
	}

	/**
	 * Each user can join offices as employee
	 * We return employment relationship for the user in current logged office
	 */
	public function officeEmployment( $office ) {
		return DigitalOfficeEmployee::where('user_id', $this->id)->where('office_id', $office->id)->first();
	}

	/**
	 * Switch the user's context to the given office.
	 *
	 * @param  mixed  $office
	 * @return bool
	 */
	public function switchOffice($office)
	{

		if (!$this->belongsToOffice($office)) {
			return false;
		}

		$this->forceFill([
			"current_office_id" => $office->id,
		])->save();

		$this->setRelation("currentOffice", $office);

		return true;
	}

	/**
	 * Get all of the offices the user owns or belongs to.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function allOffices()
	{
		return $this->ownedOffices->merge($this->offices)->sortBy("name");
	}

	/**
	 * Get all of the offices the user owns.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ownedOffices()
	{
		return $this->hasMany(DigitalOffice::class, "user_id");
	}

	/**
	 * Get all of the offices the user belongs to (as an employee).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function offices()
	{
		return $this->belongsToMany(
			DigitalOffice::class,
			DigitalOfficeEmployee::class,
			"user_id",
			"office_id"
		)
			->wherePivot('digital_office_employees.ended_at', null);
	}

	public function officeEmployee($office)
	{
		if ($this->ownsOffice($office)) {
			//return new OwnerRole;
		}

		if (!$this->belongsToOffice($office)) {
			return;
		}

		return $office->employees
			->where("user_id", $this->id)
			->where("office_id", $office->id)
			->first();
	}

	/**
	 * Determine if the user owns the given office.
	 *
	 * @param  mixed  $office
	 * @return bool
	 */
	public function ownsOffice($office)
	{
		if (is_null($office)) {
			return false;
		}

		return $this->id == $office->user_id;
	}

	/**
	 * Determine if the user belongs to the given office.
	 *
	 * @param  mixed  $office
	 * @return bool
	 */
	public function belongsToOffice($office)
	{
		if (is_null($office)) {
			return false;
		}

		return $this->ownsOffice($office) ||
			$this->offices->contains(function ($t) use ($office) {
				return $t->id == $office->id &&
					!$office->employees
						->where("office_id", $office->id)
						->where("user_id", $this->id)
						->where("ended_at", null)->isEmpty();
			});
	}

	/**
	 * Determine if the user have specific permission in an office
	 *
	 * @param  mixed  $office
	 * @param string $permission
	 * @return boolean
	 */
	public function hasOfficePermission($office, $permission)
	{

		// Grant all permissions to the office owner
		if ($this->ownsOffice($office)) {
			return true;
		}

		if (!$this->belongsToOffice($office)) {
			return;
		}
		return $office->employees
			->where("user_id", $this->id)
			->first()
			->hasPermissionTo($permission);
	}

	/**
	 *
	 * @param $office \App\Models\DigitalOffice
	 */
	public function officePermissions($office)
	{
		return $office->employees
			->where("user_id", $this->id)
			->first()
			->getAllPermissions();
	}

	/**
	 * Get the role that the user has on the office.
	 *
	 * @param  mixed  $office
	 * @return \Laravel\Jetstream\Role|null
	 */
	public function officeRole($office)
	{
		if ($this->ownsOffice($office)) {
			//return new OwnerRole;
		}

		if (!$this->belongsToOffice($office)) {
			return;
		}

		$role = $office->employees->where("user_id", $this->id)->first()->role;

		return $role ? Role::findByName($role) : null;
	}

	/**
	 *
	 */
	public function profile()
	{
		return $this->hasOne(Profile::class, "user_id", "id");
	}

	/**
	 *
	 */
	public function invites()
	{
		return $this->hasMany(Invite::class, "email", "email");
	}
	/**
	 *
	 */
	public function avatar_url()
	{
		if (!empty($this->avatar_url)) {
			return asset("storage/" . $this->avatar_url);
		}
		return (new UiAvatarsProvider())->get(User::find($this->id));
	}

	/**
	 * Transactions
	 */
	public function transactions()
	{
		return $this->morphMany(Transaction::class, "transactionable");
	}

	/**
	 * User Threads
	 */
	public function threads() {
		return $this->morphMany(Thread::class, 'sender');
	}

	/**
	 * Get withdrawal method for the user
	 * 
	 * @return array|null
	 */
	public function withdrawalTransactionMethod(Transaction $txn)
	{
		$txnPreferredMethod = $txn->preferredWithdrawalMethod();

		$userMethods = $this->withdrawal_methods;

		if (!$txnPreferredMethod || $userMethods) {
			return;
		}

		$index = array_search($txnPreferredMethod->id, array_column($userMethods, 'method_id'));

		$userTxnPreferredMethod = $userMethods[$index];

		$fields = [];

		foreach ($txnPreferredMethod->fields as $fieldIndex => $field) {
			$fields[] = [
				'label' => $field->field_label,
				'value' => $userTxnPreferredMethod['field_' . $fieldIndex]
			];
		}

		return [
			'name' => $userTxnPreferredMethod->name,
			'fields' => $fields,
		];
	}

	/**
	 *
	 */
	public function can_contact_offices()
	{
		return $this->contact_hidden_offices;
	}

	/**
	 *
	 */
	public function addToBalance(float $amount)
	{
		$this->available_balance += $amount;
		$this->save();
	}

	/**
	 *
	 */
	public function addToHoldBalance(float $amount)
	{
		$this->hold_balance += $amount;
		$this->save();
	}

	/**
	 *
	 */
	public function substractFromBalance(float $amount)
	{
		$this->available_balance = $this->available_balance - $amount;
		$this->save();
	}

	/**
	 * 
	 */
	public function loggedAs() {

		if($this->currentOffice) {
			return $this->officeEmployee($this->currentOffice);
		}

		return $this;

	}
	/**
	 * 
	 */
	public function isBanned()
	{
		return $this->banned_at != null;
	}

	/**
	 * Check if the required fields filled
	 */
	public function isAccountSettled() {
		return !empty($this->ID_number) && !empty($this->address) && !empty($this->ID_image) && !empty($this->driving_license_image);
	}
}
