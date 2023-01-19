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
    protected $fillable = ['profession_id', 'name', 'description', 'fee', 'type'];

    /**
     * 
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * 
     */
    public function getFeeLabelAttribute() {
        return money($this->fee, 'sar', true)->__toString() .( $this->type != self::ONE_TIME ? '/' . __('subscriptions.types.' . $this->type) : '');
    }

}
