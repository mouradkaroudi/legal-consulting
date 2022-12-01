<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ["name", "email", "password", "available_balance"];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ["password", "remember_token"];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    "email_verified_at" => "datetime",
  ];

  /**
   * Determine if the given office is the current office.
   *
   * @param  mixed  $digitalOffice
   * @return bool
   */
  public function isCurrentOffice($digitalOffice)
  {
    return $digitalOffice->id === $this->currentOffice->id;
  }

  /**
   * Get the current office of the user's context.
   *
   * @return \App\Models\DigitalOffice|null
   */
  public function currentOffice()
  {

    $office = Route::current()->parameter('digitalOffice');

    if(empty($office)) {
      return null;
    }

    return $office instanceof DigitalOffice ? $office : DigitalOffice::find($office);
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
   * Get all of the offices the user belongs to.
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
    );
  }

  /**
   * Determine if the user owns the given team.
   *
   * @param  mixed  $team
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
        return $t->id === $office->id;
      });
  }

  /**
   * Determine if the user have specific permission in an office
   * 
   * @param  mixed  $office
   * @param string $permission
   * @return boolean
   */
  public function hasOfficePermission( $office, $permission ) {
    // Grant all permissions to office owner
    if ($this->ownsOffice($office)) {
      return true;
    }

    if (!$this->belongsToOffice($office)) {
      return;
    }
    return $office->employees->where("user_id", $this->id)->first()->hasPermissionTo($permission);
  }

  /**
   * 
   * @param $office \App\Models\DigitalOffice
   */
  public function officePermissions( $office ) {
    return $office->employees->where("user_id", $this->id)->first()->getAllPermissions();
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
  public function invites() {
    return $this->hasMany(Invite::class, 'email', 'email');
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

  public function transactions() {
    return $this->morphMany(Transaction::class, 'transactionable');
  }

  /**
   * 
   */
  public function addToHoldBalance( $amount ) {
    $this->hold_balance += $amount;
    $this->save();
  }

  /**
   * 
   */
  public function addToCreditBalance( $amount ) {
    $this->available_balance += $amount;
    $this->save();
  }

  /**
   * 
   */
  public function addToDebitBalance( $amount ) {
    $this->available_balance -= $amount;
    $this->save();
  }

}
