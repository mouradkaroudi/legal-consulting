<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Transaction status
    public const PENDING = 'pending';
    public const FAILED = 'failed';
    public const REJECTED = 'rejected';
    public const SUCCESS = 'success';

    // Transaction source
    public const RECEIVE_EARNINGS = 'recieve_earnings';
    public const PAY_DUES = 'pay_dues';
    public const WITHDRAWALS = 'withdrawals';
    public const DEPOSIT = 'deposit';
    public const SUBSCRIPTION_FEES = 'subscription_fees';
    public const BANK_TRANSFER = 'bank_transfer';

    protected $fillable = [
        'amount',
        'fees',
        'actual_amount',
        'type',
        'source',
        'status',
        'due_date',
        'metadata'
    ];

    protected $casts = [
        "metadata" => "json",
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function office()
    {
        return $this->morphOne(DigitalOffice::class, 'transactionable');
    }

    public function user()
    {
        return $this->morphTo(User::class, 'transactionable');
    }

    public function allTransactions()
    {
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
    public function isDebit()
    {
        return $this->type == 'debit';
    }

    /**
     * Remove funds to the holder balance
     */
    public function isCredit()
    {
        return $this->type == 'credit';
    }

    /**
     * Friendly description about the transaction
     */
    public function getDescriptionAttribute()
    {

        if ($this->source == self::PAY_DUES || $this->source == self::RECEIVE_EARNINGS) {
            return __("transactions.details." . $this->source, ["order_id" => is_array($this->metadata) ? $this->metadata['order_id']: '']);
        }

        return __("transactions.details." . $this->source, [
            "amount" => money($this->actual_amount, 'SAR', true)
        ]);
    }

    /**
     * Get transaction payment method
     */
    public function getPaymentMethodAttribute() {

        if(!empty($this->metadata) && isset($this->metadata['payment_method'])) {
            return __('transactions.' . $this->metadata['payment_method']);
        }

        return '-';

    }

    /**
     * Get transaction type
     */
    public function getPaymentTypeAttribute() {
        return __('transactions.' . $this->type);
    }

    /**
     * Get transaction attachments
     */
    public function getAttachmentsAttribute() {
        
        if(!empty($this->metadata) && isset($this->metadata['attachments'])) {
            return $this->metadata['attachments']; 
        }

        return [];
    }

    /**
     * Get user preffered withdrawal method
     */
    public function preferredWithdrawalMethod() {
        if(!empty($this->metadata) && isset($this->metadata['preferred_payment_method'])) {
            return WithdrawalMethod::find($this->metadata['preferred_payment_method']); 
        }
    }

    public function getFormattedAmountAttribute()
    {
        return $this->amount . ' SAR';
    }
}
