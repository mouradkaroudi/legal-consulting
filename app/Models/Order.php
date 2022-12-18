<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  public const PAID = 'PAID';
  public const UNPAID = 'UNPAID';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    "office_id",
    "beneficiary_id",
    "subject",
    "fee",
    "status",
  ];

  public function beneficiary()
  {
    return $this->hasOne(User::class, "id", "beneficiary_id");
  }

  public function office()
  {
    return $this->hasOne(DigitalOffice::class, "id", "office_id");
  }

  public function getFormattedFeeAttribute()
  {
    return $this->fee . ' SAR';
  }
}
