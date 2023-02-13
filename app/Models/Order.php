<?php

namespace App\Models;

use Digikraaft\ReviewRating\Traits\HasReviewRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory, HasReviewRating;

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
    "amount",
    "status",
  ];

  protected $casts = [
    'amount' => 'float'
  ];

  /**
   * 
   */
  public function beneficiary()
  {
    return $this->hasOne(User::class, "id", "beneficiary_id");
  }

  // FIXME: belongs to
  public function office()
  {
    return $this->hasOne(DigitalOffice::class, "id", "office_id");
  }

  /**
   * Change order status to paid 
   */
  public function markAsPaid() {
   
    $this->status = self::PAID;
    $this->save();

  }

  /**
   * 
   */
  public function isPaid() {
    return $this->status == self::PAID;
  }

  /**
   * 
   */
  public function getTaxAmountAttribute()
  {
    $tax = setting('tax') ?? 0;

    if (empty($tax)) {
      return 0;
    }

    return $this->amount * ($tax / 100);
  }

  /**
   * 
   */
  public function getTotalAmountAttribute()
  {
    $tax = (float) setting('tax');
    dd($tax);
    if (empty($tax)) {
      return $this->amount;
    }
    return $this->amount + ($this->amount * ($tax / 100));
  }

  public function getFormattedAmountAttribute()
  {
    return (string) $this->amount . ' SAR';
  }
}
