<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

// TODO: add hide/display offices
// TODO: add supervisor to admin
// hide service => hide office
// TODO: ban users
// TODO: add payment method
class DigitalOffice extends Model
{
	use HasFactory, Notifiable;

	public const AVAILABLE = "AVAILABLE";
	public const BUSY = "BUSY";

	public const UNCOMPLETED = "UNCOMPLETED";
	public const BLOCKED = "BLOCKED"; // TODO: consider remove this

	public const PENDING = 'PENDING';
	public const PENDING_PAYMENT = 'PENDING_PAYMENT';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		"user_id",
		"name",
		"description",
		"image",
		"phone_number",
		"license_number",
		"country_code",
		"city",
		"professional_license_number",
		"commercial_registration_number",
		"municipal_license_number",
		"tax_establishment_number",
		"license_attachment",
		"location",
		"status",
		"withdrawal_methods"
	];

	/**
	 *
	 */
	public function employees()
	{
		return $this->hasMany(DigitalOfficeEmployee::class, "office_id", "id");
	}

	/**
	 *
	 */
	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	/**
	 *
	 */
	public function profession()
	{
		return $this->belongsTo(Profession::class);
	}

	/**
	 *
	 */
	public function specializations()
	{
		return $this->belongsToMany(
			Specialization::class,
			"digital_office_specializations",
			"specialization_id",
			"office_id"
		);
	}

	/**
	 *
	 */
	public function threads()
	{
		return $this->hasMany(Thread::class, "office_id", "id");
	}

	/**
	 *
	 */
	public function orders()
	{
		return $this->hasMany(Order::class, "office_id", "id");
	}

	/**
	 * 
	 */
	public function subscription() {
		return $this->morphOne(Subscription::class, 'subscriber');
	}

	/**
	 * Determine wether the office profession have subscription plan
	 * 
	 * @return bool
	 */
	public function haveSubscriptionPlan(): bool {
		return !$this->profession->subscriptions->isEmpty();
	}

	/**
	 * Determine if the office have active subscription
	 * 
	 * @return bool
	 */
	public function isSubscribed(): bool {
		return !$this->subscription->where('expire_at', null)->orWhere('expire_at', '>', Carbon::now())->get()->isEmpty();
	}

	/**
	 *
	 */
	public function scopeCompleted($query)
	{
		return $query->where("status", "!=", self::UNCOMPLETED);
	}

	public function scopeNoHidden($query)
	{
		return $query->where("is_hidden", false);
	}

	/**
	 *
	 */
	public function owner()
	{
		return $this->hasOne(User::class, "id", "user_id");
	}

	/**
	 *
	 */
	public function country()
	{
		return $this->hasOne(Country::class, "id", "country_code");
	}

	/**
	 *
	 */
	public function transactions()
	{
		return $this->morphMany(Transaction::class, "transactionable");
	}

	/**
	 *
	 */
	public function withdrawals()
	{
		return $this->morphMany(Withdrawal::class, "withdrawalable");
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

	function getLocationAttribute($value)
	{
		if (!is_array($value)) {
			$value = json_decode($value, true);
		}

		if (empty($value) || !is_array($value)) {
			return [];
		}

		return json_encode([
			"lat" => (float) $value["lat"],
			"lng" => (float) $value["lng"],
		]);
	}
}
