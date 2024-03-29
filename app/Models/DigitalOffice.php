<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;

use Illuminate\Support\Str;

class DigitalOffice extends Model
{
	use HasFactory, Notifiable;

	public const AVAILABLE = "available";
	public const BUSY = "busy";
	public const CLOSED = "closed";
	public const UNCOMPLETED = "uncompleted";

	public const PENDING = 'pending';
	public const PENDING_PAYMENT = 'pending_payment';
	
	protected $fillable = [
		"user_id", // TODO: remove this
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

	protected $casts = [
		"withdrawal_methods" => "array",
		"display_info" => "array"
	];

	/**
	 * Retrieve office active employees
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
			'digital_office_specializations',
			'office_id'
		);
	}

	/**
	 *
	 */
	public function threads()
	{
		return $this->morphMany(Thread::class, 'receiver');
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
	public function subscription()
	{
		return $this->morphOne(Subscription::class, 'subscriber');
	}

	/**
	 * Determine wether the office profession have subscription plan
	 * 
	 * @return bool
	 */
	public function haveSubscriptionPlan(): bool
	{
		if($this->profession) {
			return !$this->profession->subscriptions->isEmpty();
		}
		return false;
	}

	/**
	 * Determine if the office have active subscription
	 * 
	 * @return bool
	 */
	public function isSubscribed(): bool
	{
		return $this->subscription && !$this->subscription->where('expire_at', null)->orWhere('expire_at', '>', Carbon::now())->get()->isEmpty();
	}

	/**
	 * Determine if the office is setuped
	 * 
	 * @return bool
	 */
	public function isSetuped(): bool
	{
		return in_array($this->status, [self::AVAILABLE, self::BUSY, self::CLOSED]);
	}

	/**
	 * Determine if office can accpet new messages
	 * 
	 * @return bool
	 */
	public function canAcceptNewMessage()
	{
		return $this->status == self::AVAILABLE;
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
	public function scopeSubscribed($query)
	{
		return $query->whereHas('subscription', function (Builder $query) {
			$query->where('expire_at', null)->orWhere('expire_at', '>=', Date::now());
		});
	}

	/**
	 *  
	 */
	public function scopeSetuped(Builder $query)
	{
		return $query->whereIn('status', [self::AVAILABLE, self::BUSY, self::CLOSED])->where('banned_at', null);
	}

	/**
	 * 
	 */
	public function scopeNoHidden(Builder $query)
	{
		return $query->where('is_hidden', false);
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

	public function isBanned()
	{
		return $this->banned_at != null;
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

		if (!$txnPreferredMethod || !$userMethods) {
			return;
		}

		$index = array_search($txnPreferredMethod->id, array_column($userMethods, 'method_id'));

		$userTxnPreferredMethod = $userMethods[$index];
		$fields = [];
		foreach ($txnPreferredMethod->information_required as $fieldIndex => $field) {
			$fields[] = [
				'label' => $field['field_label'],
				'value' => $userTxnPreferredMethod['field_' . $fieldIndex]
			];
		}

		return [
			'name' => $txnPreferredMethod->name,
			'fields' => $fields,
		];
	}

	/**
	 * 
	 */
	public function getUrlNameAttribute()
	{
		return Str::replace(' ', '-', $this->name);
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
