<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Transaction status
    public const PENDING = 'PENDING';
    public const FAILED = 'FAILED';
    public const SUCCESS = 'SUCCESS';

    // Transaction source
    public const RECEIVE_EARNINGS = 'RECEIVE_EARNINGS';
    public const PAY_DUES = 'PAY_DUES';
    public const RECHARGE = 'RECHARGE';
    public const WITHDRAWALS = 'WITHDRAWALS';

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

    /**
     * Add funds to the holder balance
     */
    public function isDebit() {
        return $this->type === 'debit';
    }

    /**
     * Remove funds to the holder balance
     */
    public function isCredit() {
        return $this->type === 'credit';
    }

    public function getFormattedAmountAttribute()
    {
      return $this->amount . ' SAR';
    }

}
