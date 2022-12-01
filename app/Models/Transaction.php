<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const PENDING = 'PENDING';
    public const FAILED = 'FAILED';
    public const SUCCESS = 'SUCCESS';
    public const RECEIVE_EARNINGS = 'RECEIVE_EARNINGS';
    public const PAY_DUES = 'PAY_DUES';
    public const RECHARGE = 'RECHARGE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'type',
        'source',
        'status',
        'due_date',
        'metadata'
    ];


    public function transactionable()
    {
        return $this->morphTo();
    }

    public function office() {
        return $this->morphOne(DigitalOffice::class, 'transactionable');
    }

    public function user() {
        return $this->morphTo(User::class, 'transactionable');
    }

    public function allTransactions() {
        return $this->offices->merge($this->users);
    }

    public function completeTransaction()
    {
        $this->status = self::SUCCESS;
        $this->save();
    }

    public function refuseTransaction()
    {
        $this->status = self::FAILED;
        $this->save();
    }

    public function getFormattedAmountAttribute()
    {
      return $this->amount . ' SAR';
    }

}
