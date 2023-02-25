<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements FilamentUser
{
	use HasFactory, Notifiable, HasRoles, CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ["name", "email", "password"];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = ["password", "remember_token"];

	/**
	 *
	 */
	public function canAccessFilament():bool
	{
		return true;
	}

}
