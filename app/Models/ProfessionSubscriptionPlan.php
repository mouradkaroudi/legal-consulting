<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionSubscriptionPlan extends Model
{
    use HasFactory;

    public const ONE_TIME = 'one-time';
    public const MONTHLY = 'monthly';
    public const YEARLY = 'yearly';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['profession_id', 'name', 'description', 'amount', 'type'];

    /**
     * 
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * Each subscription plan belong to a profession. Professions have translatable columns
     */
    public function professionTranslation()
    {
        return $this->belongsTo(ProfessionTranslation::class, 'profession_id', 'id');
    }

    /**
     * 
     */
    public function getTaxAmountAttribute()
    {
        $tax = (float) setting('tax');

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

        if (empty($tax)) {
            return $this->amount;
        }

        return $this->amount + $this->amount * ($tax / 100);
    }

    /**
     * 
     */
    public function getFeeLabelAttribute()
    {
        return money($this->amount, 'sar', true)->__toString() . ($this->type != self::ONE_TIME ? '/' . __('subscriptions.types.' . $this->type) : '');
    }
}
