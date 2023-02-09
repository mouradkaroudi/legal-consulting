<?php

namespace App\Models;

use App\Mail\InviteCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class Invite extends Model
{
  use HasFactory;

  protected $fillable = ["office_id", "email", "token"];

  /**
   * 
   */
  public function office() {
    return $this->hasOne(DigitalOffice::class, 'id', 'office_id');
  }

  /**
   * 
   */
  public function user() {
    return $this->hasOne(User::class, 'email', 'email');
  }

  /**
   * The "booted" method of the model.
   *
   * @return void
   */
  protected static function booted()
  {
    static::created(function ($invite) {
        if(App::environment() === 'production') {
          Mail::to($invite->email)->send(new InviteCreated($invite));
        }
    });
  }
}
