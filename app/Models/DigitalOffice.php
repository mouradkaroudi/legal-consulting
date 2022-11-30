<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class DigitalOffice extends Model
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
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
		return $query->where("status", "!=", "uncomplete");
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
