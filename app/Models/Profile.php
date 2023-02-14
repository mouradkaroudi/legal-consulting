<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	use HasFactory;

	public const AVAILABLE = 'AVAILABLE';
	public const BUSY = 'BUSY';
	public const UNCOMPLETED = 'UNCOMPLETED';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		"gender",
		"experiences",
		"education",
		"car_license_image",
		"professional_license_number",
		"professional_license_image",
		"status"
	];

	// automatically handles json_encode, json_decode to php object
	protected $casts = [
		"experiences" => "array",
		"education" => "array",
	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function getIsCompletedAttribute() {
		return $this->status !== self::UNCOMPLETED;
	}

	public function getGenderLabelAttribute()
	{
		return $this->gender ? ($this->gender == "male" ? "ذكر" : "أنثى") : "-";
	}
}
