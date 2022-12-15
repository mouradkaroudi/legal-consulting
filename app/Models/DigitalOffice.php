<?php

namespace App\Models;

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

	public const AVAILABLE = 'AVAILABLE';
	public const BUSY = 'BUSY';
	public const UNCOMPLETED = 'UNCOMPLETED';
	public const BLOCKED = 'BLOCKED';

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
	public function scopeCompleted($query)
	{
		return $query->where("status", "!=", self::UNCOMPLETED);
	}

	public function scopeNoHidden($query) {
		return $query->where('is_hidden', false);
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
